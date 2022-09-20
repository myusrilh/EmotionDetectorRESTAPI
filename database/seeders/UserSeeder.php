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
        DB::table('users')->insert([
            [
                'fullname' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
                'password' => 'admin',
                'level' => 'admin',
                'remember_token' => NULL,
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => NULL,
            ],
            [
                'fullname' => 'dr. Franky Grinder',
                'email' => 'franky@example.com',
                'email_verified_at' => Carbon\Carbon::now()->toDateTimeString(),
                'password' => 'franky',
                'level' => 'doctor',
                'remember_token' => NULL,
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => NULL,
            ],
            [
                'fullname' => 'Jimmy Neutron',
                'email' => 'jimmy@example.com',
                'email_verified_at' => NULL,
                'password' => 'jimmy',
                'level' => 'patient',
                'remember_token' => NULL,
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => NULL,
            ]
        ]
        );
    }
}
