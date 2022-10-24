<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AllFieldsRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Product;
use Image;

class ProfileController extends Controller
{
    public function profile(){
      return view('profile');
    }

    public static function getCategories(){
      $categories = Category::get();
      return $categories;
    }

    public static function categoryCheckbox(){
      $categories = self::getCategories();
      $count = $categories->count();
      $checkbox = "<div class='btn-group my-3' role='group'>";
      for ($i=1;$i<$count;$i++){
        $category = $categories->where('id', $i)->first();
        $checkbox .= "<input class='btn-check' type='checkbox' name='category[]' id='{$category->name}' value='{$category->id}'>";
        $checkbox .= "<label class='btn btn-outline-primary' for='{$category->name}'>{$category->name}</label>";
        if($i % 5 === 0){
          $checkbox .= "</div>
                        <div class='btn-group' role='group'>";
        }
      }
      $checkbox .= "</div>";
      return $checkbox;
    }


    public function addProduct(AllFieldsRequest $request){
      $categories = $request->post('category');
      $validated = $request->validated();
      $image = $request->file('productImage');
      $input['imagename'] = bin2hex(random_bytes(6).time()).'.'.$image->extension();
      $filePath = public_path('/product_images');
      $img = Image::make($image->path());
      $img->resize(250, 250, function ($const) {
          $const->aspectRatio();
      })->save($filePath.'/'.$input['imagename']);
      $filePath = public_path('/search_icon');
      $img->resize(50, 50, function ($const) {
          $const->aspectRatio();
      })->save($filePath.'/'.$input['imagename']);
      $filePath = public_path('/images');
      $image->move($filePath, $input['imagename']);
      $product = Product::create([
        'name'        => $request->post('productName'),
        'image'       => $input['imagename'],
        'description' => $request->post('productDescription'),
        'price'       => $request->post('productPrice'),
        'quantity'    => $request->post('productQuantity')
      ]);
      if(count($categories) > 0){
        $product->categories()->attach($categories);
      }
      return back();
    }
}
