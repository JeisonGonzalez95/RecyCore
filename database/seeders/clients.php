<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class clients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'Paisas Club',
                'nit' => '123456789-0',
                'phone' => 3001234567,
                'email' => 'alfa@example.com',
                'address' => 'Calle 123 #45-67',
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azafatas VIP',
                'nit' => '987654321-0',
                'phone' => 3109876543,
                'email' => 'beta@example.com',
                'address' => 'Carrera 89 #12-34',
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pereiranas Club',
                'nit' => '112233445-5',
                'phone' => 3204567890,
                'email' => 'gamma@example.com',
                'address' => 'Av. Siempre Viva 742',
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
