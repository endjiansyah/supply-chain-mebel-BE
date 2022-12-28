<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    function index()
    {
        $barang = Barang::query()
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id')
            ->join('material', 'barang.id_material', '=', 'material.id')
            ->select('barang.*', 'kategori.nama_kategori', 'material.nama_material')
            ->orderBy('barang.kode')
            ->get();
        // $barang = Barang::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list barang",
            "data" => $barang
        ]);
    }

    function show($id)
    {
        $barang = Barang::query()->where("id", $id)->first();

        if (!isset($barang)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $barang
        ]);
    }

    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['nama_barang'])) {
            return response()->json([
                "status" => false,
                "message" => "nama_barang kosong",
                "data" => null
            ]);
        }

        $file = $request->file("gambar");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $payload['gambar'] =  $path;

        $barang = Barang::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $barang
        ]);
    }

    function update(Request $request, $id)
    {
        $barang = Barang::query()->where("id", $id)->first();
        if (!isset($barang)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $payload['gambar'] = $path;

            $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $barang->gambar);
            $gambar = public_path($lokasigambar);
            unlink($gambar);
        }

        $barang->fill($payload);
        $barang->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $barang
        ]);
    }

    function destroy(Request $request, $id)
    {
        $barang = Barang::query()->where("id", $id)->first();
        if (!isset($barang)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        if ($barang->gambar != '') {
            $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $barang->gambar);
            $gambar = public_path($lokasigambar);
            unlink($gambar);
        }
        $barang->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $barang
        ]);
    }
}
