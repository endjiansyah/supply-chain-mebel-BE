<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MaterialController;
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

// ----------( kategori )---------
Route::get("/kategori", [KategoriController::class, "index"]);
Route::get("/kategori/{id}", [KategoriController::class, "show"]);
Route::post("/kategori", [KategoriController::class, "store"]);
Route::post("/kategori/{id}/edit", [KategoriController::class, "update"]);
Route::post("/kategori/{id}/delete", [KategoriController::class, "destroy"]);

// ----------( material )---------
Route::get("/material", [MaterialController::class, "index"]);
Route::get("/material/{id}", [MaterialController::class, "show"]);
Route::post("/material", [MaterialController::class, "store"]);
Route::post("/material/{id}/edit", [MaterialController::class, "update"]);
Route::post("/material/{id}/delete", [MaterialController::class, "destroy"]);
