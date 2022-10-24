<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class SettingsController extends Controller
{
    public static function getInfo(){
      $info = Auth::user();
      return $info;
    }
    public function resetPassword(Request $request){
      $info = self::getInfo();

      if (Hash::check($request->post('current'), $info->password) && $request->post('new') === $request->post('cNew')) {
        $hash = Hash::make($request->post('new'));
        Customer::where('id', Auth::user()->id)
                ->update(['password' => $hash]);
        return back();
      }else{
        return back()->withErrors(['msg' => "Either current password was wrong or new password wasn't confirmed correctly!"]);
      }
    }
}
