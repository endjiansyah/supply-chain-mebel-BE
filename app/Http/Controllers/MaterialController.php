<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    function index()
    {
        $material = Material::query()
                    ->leftjoin('barang', 'barang.id_material', '=', 'material.id')
                    ->select(Barang::raw('count(barang.id) as total,material.*'))
                    ->groupBy('material.id')
                    ->get();
        return response()->json([
            "status" => true,
            "message" => "list material",
            "data" => $material
        ]);
    }


    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['nama_material'])) {
            return response()->json([
                "status" => false,
                "message" => "material kosong",
                "data" => null
            ]);
        }

        $material = Material::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $material
        ]);
    }

    function update(Request $request, $id)
    {
        $material = Material::query()->where("id", $id)->first();
        if (!isset($material)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $material->fill($payload);
        $material->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $material
        ]);
    }

    function destroy($id)
    {
        $material = Material::query()->where("id", $id)->first();
        if (!isset($material)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $material->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $material
        ]);
    }
}
