<?php

namespace App\Http\Controllers;

use App\Models\Log as ModelsLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    function show($id)
    {
        $order = ModelsLog::query()
        ->join('status', 'log.status', '=', 'status.id')
        ->join('user', 'log.id_user', '=', 'user.id')
        ->select('log.*','status.nama_status','user.nama')
        ->where("log.id_order", $id)
        ->orderBy("log.created_at", "desc")
        ->get();

        if (!isset($order)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $order
        ]);
    }

     function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['id_order'])) {
            return response()->json([
                "status" => false,
                "message" => "isi yang bener",
                "data" => null
            ]);
        }
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->hashName();
            $file->move('attachment', $filename);
            $path = $request->getSchemeAndHttpHost() . '/attachment/' . $filename;
            $payload['attachment'] = $path;
        }

        $log = ModelsLog::query()->create($payload);

        return response()->json([
            "status" => true,
            "message" => "nice",
            "data" => $log
        ]);
    }
}
