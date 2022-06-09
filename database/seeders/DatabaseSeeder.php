<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        NavbarSeeder::class,
        RoleSeeder::class,
        CategorySeeder::class,
        CustomerSeeder::class,
        OrderSeeder::class,
        ProductSeeder::class,
        ProductCategorySeeder::class
      ]);
    }
}
