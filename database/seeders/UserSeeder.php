<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'fullname' => 'Admin',
                    'email' => 'admin@example.com',
                    'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'password' => bcrypt('admin'),
                    'level' => 'admin',
                    'profile_picture' => 'profile_picture1.png',
                    'remember_token' => NULL,
                    // 'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => NULL,
                ],
                [
                    'fullname' => 'dr. Franky Grinder',
                    'email' => 'franky@example.com',
                    'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'password' => bcrypt('franky'),
                    'level' => 'doctor',
                    'profile_picture' => 'profile_picture2.png',
                    'remember_token' => NULL,
                    // 'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => NULL,
                ],
                [
                    'fullname' => 'Jimmy Neutron',
                    'email' => 'jimmy@example.com',
                    'email_verified_at' => NULL,
                    'password' => bcrypt('jimmy'),
                    'level' => 'patient',
                    'profile_picture' => 'profile_picture2.png',
                    'remember_token' => NULL,
                    // 'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => NULL,
                ]
            ]
        );
    }
}
