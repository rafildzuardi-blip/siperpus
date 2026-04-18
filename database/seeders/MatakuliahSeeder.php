<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('matakuliah')->insert([
            ['kode_matakuliah' => 'IF202401',
             'nama_matakuliah' => 'Kalkulus',
             'sks' => 2, 
             'created_at' => now(), 
             'updated_at' => now()],
            ['kode_matakuliah' => 'IF202402', 
            'nama_matakuliah' => 'Multimedia', 
            'sks' => 3, 
            'created_at' => now(), 
            'updated_at' => now()],
        ]);
    }
}