<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $judulBuku = [
        'Belajar Laravel',
        'Laravel untuk Pemula',
        'Mastering Laravel',
        'Dasar Pemrograman C++',
        'Pemrograman C++ Lanjut',
        'Jaringan Komputer',
        'Konsep Jaringan Dasar',
        'Algoritma dan Struktur Data',
        'Struktur Data Lanjut',
        'Pemrograman Web Modern',
        'Web Development dengan PHP',
        'Machine Learning Dasar',
        'Pengenalan Machine Learning',
        'Artificial Intelligence',
        'Konsep Kecerdasan Buatan',
    ];

        for ($i = 0; $i < 50; $i++) {
        $data = [
            'judul' =>$faker->unique()->randomElement($judulBuku),
            'penulis' =>$faker->name(),
            'harga' =>$faker->numberBetween(50000,200000),
            'tahun_terbit' =>$faker->year(),
            'kategori_id' =>DB::table('kategori')->inRandomOrder()->value('id'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('buku')->insert($data);
        }
    }
}