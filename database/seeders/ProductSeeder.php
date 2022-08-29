<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach(range(1, 10) as $index){
        DB::table('products')->insert([
          'name' => Str::random(10),
          'description' => Str::random(50),
          'image' => 'product_images/default.png',
          'price' => random_int(1, 99),
          'quantity' => random_int(0, 10),
        ]);
      }
    }
}
