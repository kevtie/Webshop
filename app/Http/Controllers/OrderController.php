<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderHistory;

class OrderController extends Controller
{
  public static function getOrderInfo(){
    $order = Order::with('products')->where('customer_id', Auth::user()->id)->first();
    return $order;
  }

  public static function checkOrder(){
      $orderInfo = self::getOrderInfo();
    if($orderInfo !== null){
      $info = $orderInfo->products;
    }else{
      $info = array();
    }
    return $info;
  }

  public function addToCart(Request $request){
    $orderInfo = $this->getOrderInfo();
    if($orderInfo === null){
      $orderInfo = Order::create([
                         'customer_id' => Auth::user()->id,
                         'order_status' => 0
      ]);
    }

    if(Product::find($request->post('productId'))->quantity >= $request->post('quantity')){
      if($orderInfo->products->contains($request->post('productId')) === true){
        $orderInfo->products()->where('product_id', $request->post('productId'))->increment('order_quantity', $request->post('quantity'));
      }else{
        $orderInfo->products()->attach($request->post('productId'), ['order_quantity' => $request->post('quantity')]);
      }
      Product::where('id', $request->post('productId'))->decrement('quantity', $request->post('quantity'));
      return redirect(route('product'));
    }else{
      return "Product not in Stock";
    }
  }


  public function removeFromCart(Request $request){
    $orderInfo = $this->getOrderInfo();
    $orderQuantity = 0;
    foreach($orderInfo->products as $order){
      $orderQuantity = $order->pivot->order_quantity;
    }
    $orderInfo->products()->detach($request->post('delete'));
    Product::where('id', $request->post('delete'))->increment('quantity', $orderQuantity);
    return redirect(route('order'));
  }

  public function payment(Request $request){
      $total = 0;
      $orderInfo = $this->getOrderInfo();
      $json2 = array();
        foreach($orderInfo->products as $product){
          $total += ($product->price * $product->pivot->order_quantity);
        }
      if(Customer::find(Auth::user()->id)->balance >= $total && $orderInfo !== null){
        $orderInfo->order_status = 1;
        $orderInfo->save();
        foreach($orderInfo->products as $product){
          $json = array('order_id' => $product->pivot->order_id,
                        'product_id' => $product->pivot->product_id,
                        'product_name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $product->pivot->order_quantity);
          array_push($json2, $json);
        }
        Customer::where('id', Auth::user()->id)->decrement('balance', $total);
        array_push($json2, array('order_status' => $orderInfo->order_status));
        $productInfo = json_encode($json2, JSON_PRETTY_PRINT);
        OrderHistory::create([
          'customer_id' => Auth::user()->id,
          'orderInfo' => $productInfo
        ]);
        $orderInfo->products()
        ->detach();
        $orderInfo->delete();
        return back();
      }else{
        return "Not enough balance";
      }
  }
}
