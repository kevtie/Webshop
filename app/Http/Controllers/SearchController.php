<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
  public static function getSearch($searchTerm){
    $products = Product::with('categories');
    if($searchTerm){
      $products->where('name','LIKE','%'.$searchTerm.'%')->get();
    }
    return $products->get();
  }

  public static function showSearch(Request $request){
    $searchResults = self::getSearch($request->post('search'));

    return view('search.index', [
      'search_results' => $searchResults
    ]);
  }

  public static function getCategorySearch($categoryName){
    if($category){
        return Category::firstWhere('name',$category)->products()->get()->orderBy('id', 'asc');
      }
      return back()->withErrors('No products with this category have been found!');
  }

  public static function showCategorySearch(Request $request){
    $searchResults = self::getCategorySearch($request->post('searchCat'));
    return view('search.index', [
      'search_results' => $searchResults
    ]);
  }
}
