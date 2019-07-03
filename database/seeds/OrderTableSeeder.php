<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("order")->insert([
         "name" => str_random(10),
         "ordernum" => bcrypt('secret'), 
     ]);
    }
}
