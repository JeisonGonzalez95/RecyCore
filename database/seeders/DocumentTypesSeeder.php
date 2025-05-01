<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('document_types')->insert([
            ['code' => 'CC', 'name' => 'Cédula de Ciudadanía'],
            ['code' => 'CE', 'name' => 'Cédula de Extranjería'],
            ['code' => 'TI', 'name' => 'Tarjeta de Identidad'],
            ['code' => 'RC', 'name' => 'Registro Civil'],
            ['code' => 'NIT', 'name' => 'Número de Identificación Tributaria'],
            ['code' => 'PAS', 'name' => 'Pasaporte'],
            ['code' => 'OTRO', 'name' => 'Otro'],
        ]);
    }
}
