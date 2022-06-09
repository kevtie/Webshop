<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user_roles')->insert([
        'name' => 'Admin'
    ]);
      DB::table('user_roles')->insert([
      'name' => 'Moderator'
    ]);
      DB::table('user_roles')->insert([
      'name' => 'Customer'
    ]);
  }
}
