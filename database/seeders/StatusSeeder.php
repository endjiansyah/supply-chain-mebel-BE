<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsStatus::query()->create( //1
            [
                'nama_status' => 'belum diproses',
                'keterangan' => 'belum diproses oleh supplier'
            ]
        );
        ModelsStatus::query()->create( //2
            [
                'nama_status' => 'diproses',
                'keterangan' => 'sedang diproses oleh supplier'
            ]
        );
        ModelsStatus::query()->create( //3
            [
                'nama_status' => 'menunggu konfirmasi',
                'keterangan' => 'selesai diproses oleh supplier, belum dikonfirmasi oleh quality control'
            ]
        );
        ModelsStatus::query()->create( //4
            [
                'nama_status' => 'ditolak QC',
                'keterangan' => 'barang produksi ditolak QC'
            ]
        );
        ModelsStatus::query()->create( //5
            [
                'nama_status' => 'terkonfirmasi',
                'keterangan' => 'sudah dikonfirmasi oleh quality control'
            ]
        );
        ModelsStatus::query()->create( //6
            [
                'nama_status' => 'selesai',
                'keterangan' => 'barang sudah sampai di gudang'
            ]
        );
    }
}
