<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    function index()
    {
        $material = Material::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list material",
            "data" => $material
        ]);
    }

    function show($id)
    {
        $material = Material::query()->where("id", $id)->first();

        if (!isset($material)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
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
