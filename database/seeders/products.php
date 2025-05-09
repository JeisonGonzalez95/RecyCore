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
                'product_name' => 'Carton',
                'slug_product' => 'CRT',
                'price_product_sale' => 650,
                'price_product_purch_f' => 250,
                'price_product_purch_c' => 350,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Soplado',
                'slug_product' => 'SLP',
                'price_product_sale' => 750,
                'price_product_purch_f' => 450,
                'price_product_purch_c' => 500,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Plastico',
                'slug_product' => 'PLST',
                'price_product_sale' => 850,
                'price_product_purch_f' => 320,
                'price_product_purch_c' => 400,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Archivo Revuelto',
                'slug_product' => 'ARCH',
                'price_product_sale' => 850,
                'price_product_purch_f' => 320,
                'price_product_purch_c' => 400,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Chatarra',
                'slug_product' => 'CHT',
                'price_product_sale' => 850,
                'price_product_purch_f' => 320,
                'price_product_purch_c' => 400,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'PET Cristal',
                'slug_product' => 'PETC',
                'price_product_sale' => 850,
                'price_product_purch_f' => 320,
                'price_product_purch_c' => 400,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Vasija',
                'slug_product' => 'VSJ',
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
