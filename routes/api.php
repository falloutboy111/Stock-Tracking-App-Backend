<?php

use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => ['role:super-admin']], function () {
    Route::apiResource("/admin", Manage::class);
    Route::apiResource("/brand", BrandManage::class, ["only" => ["store", "update", "delete"]]);
    Route::apiResource("/mall", MallManage::class, ["only" => ["store", "update", "delete"]]);
    Route::apiResource("/store", StoreManage::class, ["only" => ["store", "update", "delete"]]);
});



Route::group(['middleware' => ['role:super-admin|admin']], function () {

    Route::get("/admin/user", [Manage::class, "current_user"]);
    Route::apiResource("/brand", BrandManage::class);
    Route::apiResource("/mall", MallManage::class);
    Route::apiResource("/store", StoreManage::class);
    Route::apiResource("/staff", StaffManage::class);
});

Route::post("/user/login", [AuthController::class, "login"]);