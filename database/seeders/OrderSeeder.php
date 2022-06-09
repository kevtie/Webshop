<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;
use App\Models\Customer;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i=0; $i < 11; $i++){
      $allCustomers = Customer::all();
      $randomCustomer = $allCustomers->random();
      $randomCId = $randomCustomer->id;
        DB::table('orders')->insert([
          'customer_id' => $randomCId,
          'order_status' => 0,
        ]);
      }
    }
}
