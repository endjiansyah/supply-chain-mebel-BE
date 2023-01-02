<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
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
Route::get("/barangrecycle", [BarangController::class, "recyclebin"]);
Route::post("/barang/{id}/recycle", [BarangController::class, "recycle"]);

// ----------( kategori )---------
Route::get("/kategori", [KategoriController::class, "index"]);
Route::post("/kategori", [KategoriController::class, "store"]);
Route::post("/kategori/{id}/edit", [KategoriController::class, "update"]);
Route::post("/kategori/{id}/delete", [KategoriController::class, "destroy"]);

// ----------( material )---------
Route::get("/material", [MaterialController::class, "index"]);
Route::post("/material", [MaterialController::class, "store"]);
Route::post("/material/{id}/edit", [MaterialController::class, "update"]);
Route::post("/material/{id}/delete", [MaterialController::class, "destroy"]);

// ----------( role )---------
Route::get("/role", [RoleController::class, "index"]);

// ----------( user )---------
Route::get("/user", [UserController::class, "index"]);
Route::get("/user/{id}", [UserController::class, "show"]);
Route::post("/user", [UserController::class, "store"]);
Route::post("/user/{id}/edit", [UserController::class, "update"]);
Route::post("/user/{id}/delete", [UserController::class, "destroy"]);

// ----------( order )---------
Route::get("/order", [OrderController::class, "index"]);
Route::get("/order/{id}", [OrderController::class, "show"]);
Route::post("/order", [OrderController::class, "store"]);
Route::post("/order/{id}/edit", [OrderController::class, "update"]);
Route::post("/order/{id}/delete", [OrderController::class, "destroy"]);

// ----------( log )---------
Route::get("/log/{id}", [LogController::class, "show"]);
Route::post("/log", [LogController::class, "store"]);
// ----------( status )---------
Route::get("/status", [StatusController::class, "index"]);

// ---------{Sanctum}-------
Route::post("/login", [AuthController::class, "login"]);
Route::get("/me", [AuthController::class, "getUser"])->middleware("auth:sanctum");
