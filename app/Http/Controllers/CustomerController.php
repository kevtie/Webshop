<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerController extends Controller
{
  public function index(){
    $users = Customer::get();
    return view('customers.index', ['customers' => $customers]);
   }
}
