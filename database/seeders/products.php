<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class products extends Seeder
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
                'product_name' => 'Archivo Revuelto',
                'slug_product' => 'PL',
                'price_product_sale' => 650,
                'price_product_purch_f' => 250,
                'price_product_purch_c' => 350,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Plastico',
                'slug_product' => 'PLS',
                'price_product_sale' => 750,
                'price_product_purch_f' => 450,
                'price_product_purch_c' => 500,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'PET',
                'slug_product' => 'PT',
                'price_product_sale' => 850,
                'price_product_purch_f' => 320,
                'price_product_purch_c' => 400,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
