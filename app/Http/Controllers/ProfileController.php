<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use validator;

class ProfileController extends Controller
{
    public function profile(){
      return view('profile');
    }
    public static function getCurrentUser(){
      return Customer::where('id', Auth::user()->id)->first();
    }
    public function updateEmail(Request $request){
      $currentUser = self::getCurrentUser();
      if($request->post('newEmail') !== $currentUser->Email){

        $this->validate($request, [
          'newEmail' => 'required|email|unique:customers,Email',
        ]);
        $currentUser->update(['Email' => $request->post('newEmail')]);
        return back();
      }
    }
}
