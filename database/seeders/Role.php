<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsRole::query()->create(
            [
                'nama' => 'Admin',
                'keterangan' => 'Admin Utama'
            ]
        );
        ModelsRole::query()->create(
            [
                'nama' => 'Gudang',
                'keterangan' => 'Admin Gudang'
            ]
        );
        ModelsRole::query()->create(
            [
                'nama' => 'Supplier',
                'keterangan' => 'Admin Supplier'
            ]
        );
        ModelsRole::query()->create(
            [
                'nama' => 'QC',
                'keterangan' => 'Quality Control'
            ]
        );
    }
}
