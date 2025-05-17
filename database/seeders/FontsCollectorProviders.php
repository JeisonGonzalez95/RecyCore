<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\provider;
use App\Models\Collector;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class FontsCollectorProviders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar un proveedor
        DB::table('providers')->insert([
            [
                'name'    => 'Aurora PET',
                'nit'     => '901391906-2',
                'phone'   => '3112362485',
                'email'   => 'aurorapet@gmail.com',
                'address' => 'Calle 12 # 38 - 83',
                'state'   => true,
            ],
            [
                'name'    => 'Tatuajes',
                'nit'     => '901391907-3',
                'phone'   => '3112362485',
                'email'   => 'vidrio@gmail.com',
                'address' => 'Calle 12 # 38 - 83',
                'state'   => true,
            ]
        ]);


        // Insertar un recolector
        Collector::create([
            'name'     => 'Predeterminado',
            'type_dni' => 1,
            'dni'      => '1020304050',
            'country'  => 'CO',
            'phone'    => 3119876543,
            'email'    => 'recolector@demo.com',
            'address'  => 'Carrera 5 #6-78',
            'state'    => true,
        ]);

        // Insertar un cliente
        Client::create([
            'name'    => 'INSTITUCION EDUCATIVA LICEO DE CERVANTES EL RETIRO',
            'nit'     => '860006764-6',
            'phone'   => 3124567890,
            'email'   => 'cliente@demo.com',
            'address' => 'Avenida 10 #11-12',
            'state'   => true,
        ]);
    }
}
