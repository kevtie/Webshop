<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Navbar;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=NavbarSeeder
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'Home',
                'route' => 'home',
                'ordering' => 1,
            ],
            [
                'name' => 'Products',
                'route' => 'product',
                'ordering' => 2,
            ],
            [
                'name' => 'Cart',
                'route' => 'order',
                'ordering' => 3,
            ],
            [
                'name' => 'OrderHistory',
                'route' => 'orderhistory',
                'ordering' => 4,
            ]
        ];

        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}
