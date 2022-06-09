<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\customers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('customers')->insert([
        'name' => 'kevtie',
        'password' => '$2a$12$trK0k1jF8XGugVccxa1VF.InW1.R.mwpglKu3jGpSM0TE0/ZNFSvW',
        'balance' => 100000,
        'role_id' => 1
      ]);
      foreach(range(1, 10) as $index){
        DB::table('customers')->insert([
          'name' => Str::random(10),
          'password' => Hash::make('password'),
          'balance' => random_int(100, 99999),
          'role_id' => 3
        ]);
      }
    }
}
