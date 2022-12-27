<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsStatus::query()->create(
            [
                'nama_status' => 'belum diproses',
                'keterangan' => 'belum diproses oleh supplier'
            ]
        );
        ModelsStatus::query()->create(
            [
                'nama_status' => 'diproses',
                'keterangan' => 'sedang diproses oleh supplier'
            ]
        );
        ModelsStatus::query()->create(
            [
                'nama_status' => 'menunggu konfirmasi',
                'keterangan' => 'selesai diproses oleh supplier, belum dikonfirmasi oleh quality control'
            ]
        );
        ModelsStatus::query()->create(
            [
                'nama_status' => 'terkonfirmasi',
                'keterangan' => 'sudah dikonfirmasi oleh quality control'
            ]
        );
        ModelsStatus::query()->create(
            [
                'nama_status' => 'selesai',
                'keterangan' => 'barang sudah sampai di gudang'
            ]
        );
    }
}
