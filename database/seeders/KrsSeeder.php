<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('krs')->insert([
            [
                'npm' => '2300000001',            
                'kode_matakuliah' => 'IF202401', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '2300000002',       
                'kode_matakuliah' => 'IF202402',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}