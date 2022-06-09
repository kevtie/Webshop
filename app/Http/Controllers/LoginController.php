<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use validator;

class LoginController extends Controller
{
  public function index(){
      return view('login');
  }

  public function authenticate(Request $request)
  {
      $credentials = $request->validate([
          'name' => ['required'],
          'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {

          $request->session()->regenerate();

          return redirect(route('home'));
      }

      return back()->withErrors([
          'name' => 'The provided credentials do not match our records.',
      ]);
  }

  public function logout(Request $request)
  {
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
  }
}
