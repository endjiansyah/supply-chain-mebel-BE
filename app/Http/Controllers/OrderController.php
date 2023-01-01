<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index()
    {
        $order = Order::query()
        ->join('user', 'order.id_user', '=', 'user.id')
        ->join('barang', 'order.id_barang', '=', 'barang.id')
        ->join('status', 'order.status', '=', 'status.id')
            ->select('order.*', 'barang.nama_barang', 'user.nama as nama_user','status.nama_status')
            ->orderBy('order.status','asc')
            ->orderBy('order.created_at','desc')
        ->get();

        return response()->json([
            "status" => true,
            "message" => "list order",
            "data" => $order
        ]);
    }

    function show($id)
    {
        $order = Order::query()
        ->join('status', 'order.status', '=', 'status.id')
        ->select('order.*','status.nama_status')
        ->where("order.id", $id)
        ->first();

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
        if (!isset($payload['id_barang'])) {
            return response()->json([
                "status" => false,
                "message" => "barang kosong",
                "data" => null
            ]);
        }

        $order = Order::query()->create($payload);
        // ------
        $barang = Barang::query()->where("id", $payload['id_barang'])->first();
        $kode = 'O'.$order['id'].$barang['kode'];
        $ngisikode = [
            'kode' => $kode
        ];
        $order->fill($ngisikode);
        $order->save();
        // -------
        return response()->json([
            "status" => true,
            "message" => "data tersimpan dengan kode ".$kode,
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

        $order->fill($payload);
        $order->save();

        return response()->json([
            "status" => true,
            "message" => "Status berhasil diubah",
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
