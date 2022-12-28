<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    function index()
    {
        $log = Log::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list log",
            "data" => $log
        ]);
    }

    function show($id)
    {
        $log = Log::query()->where("id", $id)->first();

        if (!isset($log)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $log
        ]);
    }

    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['id_order'])) {
            return response()->json([
                "status" => false,
                "message" => "log kosong",
                "data" => null
            ]);
        }

        $log = Log::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $log
        ]);
    }
}
