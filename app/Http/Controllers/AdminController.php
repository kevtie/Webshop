<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AllFieldsRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Product;
use Image;

class AdminController extends Controller
{
  public static function getCategories(){
    $categories = Category::get();
    return $categories;
  }

  public static function categoryCheckbox(){
    $categories = self::getCategories();
    return view('elements/categoryCheckbox', ['categories' => $categories]);
  }

  public function addCategory(Request $request){
    $this->validate($request, [
                      'categoryName' => 'required|unique:categories,name'
                      ]);
    Category::create([
                     'name'        => $request->post('categoryName'),
                     'description' => $request->post('categoryDescription'),
                    ]);
    return back();
  }


  public function addProduct(AllFieldsRequest $request){
    $categories = $request->post('category');
    $validated = $request->validated();
    $imageName = "";
    if($request->has('productImage')){
      $imageCropper = new \App\Helpers\ImageCropper($request->file('productImage'));
      $imageCropper->saveCroppedImage(250, 250, public_path('/product_images'));
      $imageCropper->saveCroppedImage(50, 50, public_path('/search_icon'));
      $imageCropper->saveImage(public_path('/images'));
      $imageName = $imageCropper->getImageName();
    }
    $product = Product::create([
      'name'        => $request->post('productName'),
      'image'       => $imageName,
      'description' => $request->post('productDescription'),
      'price'       => $request->post('productPrice')*100,
      'quantity'    => $request->post('productQuantity')
    ]);
    if(count($categories) > 0){
      $product->categories()->attach($categories);
    }
    return back();
  }
}
