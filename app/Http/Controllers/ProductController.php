<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public static function getProduct(){
      $products = Product::with('categories')->paginate(9)
                                             ->onEachSide(1);
      return $products;
    }

}
