<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            "nama" => "hilih",
            "email" => "hilih@gmail.com",
            "password" => "hilih",
            "id_role" => "1",
            "remember_token" => Str::random(10)
        ]);

        User::query()->create([
            "nama" => "kang jogo gudang",
            "email" => "gudang@g.c",
            "password" => "hilih",
            "id_role" => "2",
            "remember_token" => Str::random(10)
        ]);

        User::query()->create([
            "nama" => "wong sibuk",
            "email" => "supplier@g.c",
            "password" => "hilih",
            "id_role" => "3",
            "remember_token" => Str::random(10)
        ]);

        User::query()->create([
            "nama" => "wong galak",
            "email" => "qc@g.c",
            "password" => "hilih",
            "id_role" => "4",
            "remember_token" => Str::random(10)
        ]);
    }
}
