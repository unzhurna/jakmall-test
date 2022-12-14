<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name'=> 'Product 1',
                'price'=> '1000'
            ],
            [
                'id'=> 2,
                'name'=> 'Product 2',
                'price'=> '2000'
            ],
            [
                'id'=> 3,
                'name'=> 'Product 3',
                'price'=> '3000'
            ],
            [
                'id'=> 4,
                'name'=> 'Product 4',
                'price'=> '4000'
            ],
            [
                'id'=> 5,
                'name'=> 'Product 5',
                'price'=> '5000'
            ]
        ]);
    }
}
