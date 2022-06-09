<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public static function getProductPage($key){
      $products = Product::with('categories')->where('id', $key)->first();

      return $products;
    }
}
