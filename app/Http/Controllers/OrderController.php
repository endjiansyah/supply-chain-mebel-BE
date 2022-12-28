<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $order = Order::query()->get();

        return response()->json([
            "status" => true,
            "message" => "list order",
            "data" => $order
        ]);
    }

    function show($id)
    {
        $order = Order::query()->where("id", $id)->first();

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
        if (!isset($payload['nama_order'])) {
            return response()->json([
                "status" => false,
                "message" => "nama_order kosong",
                "data" => null
            ]);
        }

        $file = $request->file("attachment");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $payload['attachment'] =  $path;

        $order = Order::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $order
        ]);
    }

    function update(Request $request, $id)
    {
        $order = Order::query()->where("id", $id)->first();
        if (!isset($order)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $payload['attachment'] = $path;

            $lokasiattachment = str_replace($request->getSchemeAndHttpHost(), '', $order->attachment);
            $attachment = public_path($lokasiattachment);
            unlink($attachment);
        }

        $order->fill($payload);
        $order->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $order
        ]);
    }

    function destroy(Request $request, $id)
    {
        $order = Order::query()->where("id", $id)->first();
        if (!isset($order)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        if ($order->attachment != '') {
            $lokasiattachment = str_replace($request->getSchemeAndHttpHost(), '', $order->attachment);
            $attachment = public_path($lokasiattachment);
            unlink($attachment);
        }
        $order->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $order
        ]);
    }
}
