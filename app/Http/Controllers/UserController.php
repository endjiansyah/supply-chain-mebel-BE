<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = User::query()
            ->join('role', 'user.id_role', '=', 'role.id')
            ->select('user.*', 'role.nama as nama_role', 'role.keterangan as keterangan_role')
            ->where('aktif',true)
            ->orderBy('user.id_role','asc')
            ->get();

        return response()->json([
            "status" => true,
            "message" => "list user",
            "data" => $user
        ]);
    }

    function show($id)
    {
        $user = User::query()
            ->join('role', 'user.id_role', '=', 'role.id')
            ->select('user.*', 'role.nama as nama_role', 'role.keterangan as keterangan_role')
            ->where("user.id", $id)
            ->first();

        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $user
        ]);
    }


    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['nama'])) {
            return response()->json([
                "status" => false,
                "message" => "user kosong",
                "data" => null
            ]);
        }

        $user = User::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data ".$user['nama']." tersimpan",
            "data" => $user
        ]);
    }

    function update(Request $request, $id)
    {
        $user = User::query()->where("id", $id)->first();
        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $user->fill($payload);
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $user
        ]);
    }

    function destroy($id)
    {
        $user = User::query()->where("id", $id)->first();
        if (!isset($user)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = [
            'aktif' => false
        ];

        $user->fill($payload);
        $user->save();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $user
        ]);
    }
}
