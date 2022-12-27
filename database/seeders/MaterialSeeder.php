<?php

namespace Database\Seeders;

use App\Models\Material as ModelsMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsMaterial::query()->create(
            [
                'nama_material' => 'Jati',
                'keterangan' => 'Kayu Jati'
            ]
        );
        ModelsMaterial::query()->create(
            [
                'nama_material' => 'Mahony',
                'keterangan' => 'Kayu Mahony'
            ]
        );
    }
}
