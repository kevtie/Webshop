<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public function getProductPage(Request $request, Product $product) {
      //$products = Product::with('categories')->where('id', $product)->first();

      return view('productDetail', ['product' => $product, 'categories'=>$product->categories]);
    }

    public static function seperate(string $categories){

      $name = explode(', ', $categories);
      return $name;
    }
}
