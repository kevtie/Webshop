<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AllFieldsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if(Auth::user()->role_id === 1){
        return true;
      }else{
        return false;
      }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
          'productName'        => "required|unique:products,name",
          'productDescription' => "required",
          'productImage'       => "image|mimes:jpg,jpeg,png,svg,gif|max:2048",
          'productPrice'       => "required",
          'productQuantity'    => "required"
      ];
    }
}
