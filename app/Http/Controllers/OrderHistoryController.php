<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderHistory;
use App\Models\customer;


class OrderHistoryController extends Controller
{
    public static function getOrderHistory(){
      $history = OrderHistory::with('customers')->where('customer_id', Auth::user()->id)
                                                ->orderby('id', 'desc')
                                                ->paginate(5)
                                                ->onEachSide(0);
      return $history;
    }
    public static function tableGen(string $history){
      $json = json_decode($history, true);
      $temp  = "<table class='table table-hover'>";
      $temp .= "<tr scope='col'><th>Order</th>";
      $temp .= "<th scope='col'>Product id</th>";
      $temp .= "<th scope='col'>Product</th>";
      $temp .= "<th scope='col'>Price</th>";
      $temp .= "<th scope='col'>Quantity</th>";
      $temp .= "<th scope='col'>Order status</th></tr>";
      foreach($json as $item)
      {
        $temp .= "<tr>";
        $temp .= "<td>" . ($item["order_id"]?? '') . "</td>";
        $temp .= "<td>" . ($item["product_id"] ?? '') . "</td>";
        $temp .= "<td>" . ($item["product_name"] ?? '') . "</td>";
        $temp .= "<td>" . ($item["price"] ?? '') . "</td>";
        $temp .= "<td>" . ($item["quantity"] ?? '') . "</td>";
        switch($item["order_status"] ?? ''){
          case 1:
            $temp .= "<td>Purchase completed</td>";
            break;
          case 0:
            $temp .= "<td>Purchase cancelled</td>";
            break;
          case '':
            $temp .= "<td></td>";
            break;
        }
        $temp .= "</tr>";
      }
      $temp .= "</table><br>";
      return $temp;
    }
}
