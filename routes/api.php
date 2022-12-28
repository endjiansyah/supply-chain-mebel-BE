<?php

use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ----------( barang )---------
Route::get("/barang", [BarangController::class, "index"]);
Route::get("/barang/{id}", [BarangController::class, "show"]);
Route::post("/barang", [BarangController::class, "store"]);
Route::post("/barang/{id}/edit", [BarangController::class, "update"]);
Route::post("/barang/{id}/delete", [BarangController::class, "destroy"]);
