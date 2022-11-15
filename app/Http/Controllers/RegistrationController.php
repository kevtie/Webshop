<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use validator;

class RegistrationController extends Controller
{
  public function register(Request $request)
  {
    $this->validate($request, [
        'registerName' => 'required|unique:customers,name',
        'registerEmail' => 'required|email|unique:customers,Email',
        'registerPassword' => 'required'
      ]);
      $hashedPassword = bcrypt($request->post('registerPassword'));
      $user = Customer::create([
                                'name'      => $request->post('registerName'),
                                'Email'     => $request->post('registerEmail'),
                                'password'  => $hashedPassword,
                                'balance'   => 0,
                                'role_id'   => Customer::role_customer_id,
                              ]);

      auth()->login($user);

      return redirect()->to(route('home'));
    }
}
