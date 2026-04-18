<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('mahasiswa')->insert([
            [
                'npm' => '2300000001',           
                'nidn' => '123456789',         
                'nama' => 'Ilyas',        
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'npm' => '2300000002',       
                'nidn' => '987654321',          
                'nama' => 'Sarah widianto',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}