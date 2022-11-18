<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Category;
use Image;

class ProductDetailController extends Controller
{
    public function getProductPage(Request $request, Product $product) {
      return view('productDetail', ['product' => $product, 'categories'=>$product->categories]);
    }

    public static function getProduct(){
      $product = Product::with('categories')->get();
      return $product;
    }

    public static function updateCheckBox($product){
      $categories = Category::get();
      $catName = $categories->pluck('name')->flatten();
      $specific = self::getProduct()->where('id', $product)->pluck('categories')->flatten()->pluck('name')->diff([$catName]);
      return view('elements/productDetailCheckbox', ['categories' => $categories, 'specific' => $specific]);
  }

    public function updateProduct(Request $request){
      $categories = $request->post('category');
      $product = self::getProduct()->where('id', $request->post('productUrl'))->first();
      $current = Product::find($request->post('productUrl'));
      $except = Product::all()->except($request->post('productUrl'));
      if($except->pluck('name')->intersect([$request->post('productName')])->isEmpty() === true){
        $current->update([
                        'name'        => $request->post('productName'),
                        'description' => $request->post('productDescription'),
                        'price'       => $request->post('productPrice')*100,
                        'quantity'    => $request->post('productQuantity'),
                         ]);
          if($request->file('productImage') !== null){
            $this->validate($request, [
              'productImage' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            ]);
            $imageCropper = new \App\Helpers\ImageCropper($request->file('productImage'));
            $imageCropper->saveCroppedImage(250, 250, public_path('/product_images'));
            $imageCropper->saveCroppedImage(50, 50, public_path('/search_icon'));
            $imageCropper->saveImage(public_path('/images'));
            $imageCropper->unlinkImage($current->image);
            $current->update([
                     'image' => $imageCropper->getImageName()
                   ]);
          }
        $product->categories()->detach();
        if($categories !== null){
          $product->categories()->attach($categories);
        }
        return back();
      }else{
        return back()->withErrors(['msg' => "This product name already exists!"]);
      }
    }

    public function deleteProduct(Request $request){
      $product = $this->getProduct()->where('id', $request->post('productUrl'))->first();
      if(file_exists('images/' . $product->image)){
      unlink('images/' . $product->image);
      unlink('product_images/' . $product->image);
      unlink('search_icon/' . $product->image);
      };
      $product->categories()->detach();
      $product->delete();
      return redirect(route('product'));
    }
}
