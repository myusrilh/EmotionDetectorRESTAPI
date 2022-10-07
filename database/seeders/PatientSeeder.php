<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'user_id' => 3,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
        ]);
    }
}
