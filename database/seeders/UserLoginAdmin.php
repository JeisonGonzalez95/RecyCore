<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserLoginAdmin extends Seeder
{
    public function run()
    {
        $exists = DB::table('users_app')->where('username', 'admin')->exists();

        if (!$exists) {
            DB::table('users_app')->insert([
                'fullname' => 'Admin RecyCore',
                'dni' => 1000000000,
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'state' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('employees')->insert([
                'fullname' => 'Admin RecyCore',
                'dni' => 1000000000,
                'email' => 'admin@example.com',
                'phone' => '10000100010',
                'rol_id' => '1',
                'area_id' => '4',
                'state' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
