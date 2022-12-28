<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = User::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list user",
            "data" => $user
        ]);
    }

    function show($id)
    {
        $user = User::query()->where("id", $id)->first();

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
            "message" => "data tersimpan",
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

        $user->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $user
        ]);
    }
}
