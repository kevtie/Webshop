<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Category;
use Image;

class ProductDetailController extends Controller
{
    public function getProductPage(Request $request, Product $product) {
      return view('productDetail', ['product' => $product, 'categories'=>$product->categories]);
    }

    public static function getProduct(){
      $product = Product::with('categories')->get();
      return $product;
    }

    public static function updateCheckBox($product){
      $categories = Category::get();
      $count = $categories->count();
      $r = $categories->pluck('name')->flatten();
      $specific = self::getProduct()->where('id', $product)->pluck('categories')->flatten()->pluck('name')->diff([$r]);
      $checkbox = "<div class='btn-group my-3' role='group'>";
      for ($i=0;$i<$count;$i++){
        $category = $categories->where('id', $i+1)->first();
        if($specific->contains($category->name) !== true){
          $checkbox .= "<input class='btn-check' type='checkbox' name='category[]' id='{$category->name}' value='{$category->id}'>
                        <label class='btn btn-outline-primary' for='{$category->name}'>{$category->name}</label>";
        }else{
          $checkbox .= "<input class='btn-check' type='checkbox' name='category[]' id='{$category->name}' value='{$category->id}' checked>
                        <label class='btn btn-outline-primary' for='{$category->name}' checked>{$category->name}</label>";
        }
        if($i % 5 === 0){
          $checkbox .= "</div>
                        <div class='btn-group' role='group'>";
        }

    }
    $checkbox .= "</div>";
      return $checkbox;
  }

    public function updateProduct(Request $request){
      $categories = $request->post('category');
      $product = Product::with('categories')->where('id', $request->post('productUrl'))->first();
      $current = Product::where('id', $request->post('productUrl'));
      $except = Product::all()->except($request->post('productUrl'));
      if($except->pluck('name')->intersect([$request->post('productName')])->isEmpty() === true){
        $current->update([
                        'name'        => $request->post('productName'),
                        'description' => $request->post('productDescription'),
                        'price'       => $request->post('productPrice'),
                        'quantity'    => $request->post('productQuantity'),
                      ]);
          if($request->file('productImage') !== null){
            $this->validate($request, [
              'productImage' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            ]);
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
            if(file_exists('images/' . $current->first()->image)){
            unlink('images/' . $current->first()->image);
            unlink('product_images/' . $current->first()->image);
            unlink('search_icon/' . $current->first()->image);
            };
            $current->update([
                     'image' => $input['imagename']
                   ]);
          }
        $product->categories()->detach();
        if($categories !== null){
          $product->categories()->attach($categories);
        }
        return back();
      }else{
        return back()->withErrors(['msg' => "This product name already exists!"]);
      }
    }

    public function deleteProduct(Request $request){
      $product = $this->getProduct()->where('id', $request->post('productUrl'))->first();
      $product->categories()->detach();
      $product->delete();
      return redirect(route('product'));
    }
}
