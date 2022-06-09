<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
  public function index(){
    $users = DB::table('customers')->get();
    return view('customers.index', ['customers' => $customers]);
   }
}
