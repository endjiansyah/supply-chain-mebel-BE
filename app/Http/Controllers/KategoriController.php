<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index()
    {
        $kategori = Kategori::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list kategori",
            "data" => $kategori
        ]);
    }

    function show($id)
    {
        $kategori = Kategori::query()->where("id", $id)->first();

        if (!isset($kategori)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $kategori
        ]);
    }


    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['nama_kategori'])) {
            return response()->json([
                "status" => false,
                "message" => "kategori kosong",
                "data" => null
            ]);
        }

        $kategori = Kategori::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $kategori
        ]);
    }

    function update(Request $request, $id)
    {
        $kategori = Kategori::query()->where("id", $id)->first();
        if (!isset($kategori)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $kategori->fill($payload);
        $kategori->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $kategori
        ]);
    }

    function destroy($id)
    {
        $kategori = Kategori::query()->where("id", $id)->first();
        if (!isset($kategori)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $kategori->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $kategori
        ]);
    }
}
