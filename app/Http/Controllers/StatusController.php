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

}
