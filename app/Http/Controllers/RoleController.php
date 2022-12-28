<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function index()
    {
        $role = Role::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list role",
            "data" => $role
        ]);
    }

    function show($id)
    {
        $role = Role::query()->where("id", $id)->first();

        if (!isset($role)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $role
        ]);
    }
}
