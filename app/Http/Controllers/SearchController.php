<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\ProductController;

class SearchController extends Controller
{
  public static function getSearch($query){
    $products = Product::with('categories');
    if($query){
      $products->where('name','LIKE','%'.$query.'%')->get();
    }
    return $products->get();
  }
  public static function showSearch(Request $request){
    //dd($request->post('search'));
    $searchResults = self::getSearch($request->post('search'));

    return view('search.index', [
      'search_results' => $searchResults
    ]);
  }
}
