<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class SearchController extends Controller
{
  public function showSearch(Request $request)
 {
    $products = Product::all();
    if($request->keyword != ''){
    $products = Product::where('name','LIKE','%'.$request->keyword.'%')->get();
    }
    return response()->json([
       'products' => $products
    ]);
  }
}
