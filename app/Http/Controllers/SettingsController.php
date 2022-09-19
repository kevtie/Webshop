<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public static function getInfo(){
      $info = Auth::user();
      return $info;
    }
    public function resetPassword(){
      $password = $info->password;
      
    }
}
