<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    function index()
    {
        $status = Status::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list status",
            "data" => $status
        ]);
    }

    function show($id)
    {
        $status = Status::query()->where("id", $id)->first();

        if (!isset($status)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $status
        ]);
    }
}
