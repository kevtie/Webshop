<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
  public function category(){
    return view('categories');
   }

   public static function getCategories(){
     return Category::get();
   }

   public static function paginateCategories(){
      return Category::paginate(5)->onEachSide(1);
   }

   public function updateCategory(Request $request){
     $category = self::getCategories()->where('id', $request->post('categoryId'))->first();
     $category->update([
                        'name'        => $request->post('categoryName'),
                        'description' => $request->post('categoryDescription'),
                      ]);
     return back();
   }

   public function deleteCategory(Request $request){
     $category = Category::with('products')->find($request->post('categoryId'));
     $category->products()->detach();
     $category->delete();
     return back();
   }
}
