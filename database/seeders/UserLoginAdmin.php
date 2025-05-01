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
        $exists = DB::table('users_app')->where('username', 'adminRc')->exists();

        if (!$exists) {
            DB::table('users_app')->insert([
                'fullname' => 'Admin RecyCore',
                'dni' => 1023946796,
                'email' => 'admin@recyplus.com',
                'username' => 'adminRc',
                'password' => Hash::make('AdminRecycore1901'),
                'state' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('employees')->insert([
                'fullname' => 'Admin RecyCore',
                'dni' => 1023946796,
                'email' => 'admin@recyplus.com',
                'phone' => '3102413174',
                'rol_id' => '1',
                'area_id' => '4',
                'state' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
