<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen')->insert([
            ['nidn' => '123456789',
             'nama' => 'Dr.Gia', 
             'created_at' => now(), 
             'updated_at' => now()],

            ['nidn' => 
            '987654321', 
            'nama' => 'Siti Aminah, M.Kom.', 
            'created_at' => now(), 
            'updated_at' => now()],
        ]);

    }
}