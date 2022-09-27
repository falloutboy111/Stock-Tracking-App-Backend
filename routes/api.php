<?php

use App\Http\Controllers\Admin\Manage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Brand\Manage as BrandManage;
use App\Http\Controllers\Mall\Manage as MallManage;
use App\Http\Controllers\Order\Manage as OrderManage;
use App\Http\Controllers\Products\GroupManage;
use App\Http\Controllers\Products\Manage as ProductsManage;
use App\Http\Controllers\Region\Manage as RegionManage;
use App\Http\Controllers\Staff\Manage as StaffManage;
use App\Http\Controllers\Store\Manage as StoreManage;
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
});



Route::group(['middleware' => ['role:super-admin|admin']], function () {

    Route::get("/admin-user", [Manage::class, "current_user"]);
    // Route::apiResource("/brand", BrandManage::class);
    Route::apiResource("/mall", MallManage::class);
    Route::apiResource("/store", StoreManage::class);
    Route::apiResource("/staff", StaffManage::class);
    Route::apiResource("/product", ProductsManage::class);
    Route::apiResource("/product-group", GroupManage::class);
    Route::apiResource("/order", OrderManage::class, ["only" => ["update"]]);
    Route::get("/order/export/{order_id}", [OrderManage::class, "export"]);
});

Route::group(['middleware' => ['role:super-admin|admin|staff']], function () {
    Route::apiResource("/order", OrderManage::class, ["only" => ["store", "index", "show"]]);

    Route::get("/region", [RegionManage::class, "get"]);
});

Route::post("/user/login", [AuthController::class, "login"]);
