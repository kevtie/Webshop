<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach(range(1, 10) as $index){
        DB::table('categories')->insert([
          'name' => Str::random(10),
          'description' => Str::random(50)
        ]);
      }
    }
}
