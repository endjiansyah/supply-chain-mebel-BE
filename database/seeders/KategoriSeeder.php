<?php

namespace Database\Seeders;

use App\Models\Kategori as ModelsKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsKategori::query()->create(
            [
                'nama_kategori' => 'Meja',
                'kode' => 'TB'
            ]
        );
        ModelsKategori::query()->create(
            [
                'nama_kategori' => 'Kursi',
                'kode' => 'CH'
            ]
        );
        ModelsKategori::query()->create(
            [
                'nama_kategori' => 'Almari',
                'kode' => 'WD'
            ]
        );
        ModelsKategori::query()->create(
            [
                'nama_kategori' => 'Tempat Tidur',
                'kode' => 'BD'
            ]
        );
    }
}
