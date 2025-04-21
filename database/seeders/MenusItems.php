<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenusItems extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Lista de menús y subítems
        $menus = [
            [
                'name' => 'Administración',
                'slug' => 'adm',
                'state' => 1,
                'items' => [
                    ['name' => 'Empleados', 'route' => 'employeesList'],
                    ['name' => 'Cargos',    'route' => 'positionList'],
                ],
            ],
            [
                'name' => 'Inventarios',
                'slug' => 'inv',
                'state' => 1,
                'items' => [
                    ['name' => 'Entradas', 'route' => 'inventaryI'],
                    ['name' => 'Salidas',  'route' => 'inventaryO'],
                ],
            ],
            [
                'name' => 'Sistemas',
                'slug' => 'sis',
                'state' => 1,
                'items' => [
                    ['name' => 'Menus',     'route' => 'menusList'],
                    ['name' => 'Productos',   'route' => 'productList'],
                    ['name' => 'Reportes', 'route' => 'machine'],
                ],
            ],
        ];

        foreach ($menus as $menu) {
            // Evitar duplicados si el seeder se ejecuta más de una vez
            $exists = DB::table('main_menus')->where('slug_menu', $menu['slug'])->exists();

            if (!$exists) {
                $menuId = DB::table('main_menus')->insertGetId([
                    'name_menu' => $menu['name'],
                    'slug_menu' => $menu['slug'],
                    'state' => $menu['state'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                foreach ($menu['items'] as $item) {
                    DB::table('menu_items')->insert([
                        'name_item' => $item['name'],
                        'route_item' => $item['route'],
                        'main_menu_id' => $menuId,
                        'state' => 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
