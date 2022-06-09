<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
      return view('home');
    }
    public function products(){
      return view('products');
    }
    public function order(){
      return view('order');
    }
    public function details(){
      return view('productDetail');
    }

}
