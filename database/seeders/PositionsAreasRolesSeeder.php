<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PositionsAreasRolesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Insertar roles
        $roles = ['Gerente', 'Jefe', 'Colaborador'];
        $roleIds = [];

        foreach ($roles as $role) {
            $existing = DB::table('employee_roles')->where('name_role', $role)->first();
            if (!$existing) {
                $roleIds[$role] = DB::table('employee_roles')->insertGetId([
                    'name_role' => $role,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $roleIds[$role] = $existing->id;
            }
        }

        // Insertar áreas
        $areas = [
            'Gerencia',
            'Finanzas',
            'Logistica',
            'Desarrollo',
            'Comercial'
        ];
        $areaIds = [];

        foreach ($areas as $area) {
            $existing = DB::table('employee_areas')->where('name_area', $area)->first();
            if (!$existing) {
                $areaIds[$area] = DB::table('employee_areas')->insertGetId([
                    'name_area' => $area,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                $areaIds[$area] = $existing->id;
            }
        }
    }
}
