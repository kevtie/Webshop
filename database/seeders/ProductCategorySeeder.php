<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $allCategories = Category::all();
      $allProducts = Product::all();
      for($i=0; $i < 16; $i++){
        $randomCategory = $allCategories->random();
        $randomProduct = $allProducts->random();
        $randomProduct->categories()->attach($randomCategory->id);
      }
    }
}
