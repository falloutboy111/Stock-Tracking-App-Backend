<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Brand\Manage as BrandManage;
use App\Http\Controllers\Staff\Manage;
use App\Http\Controllers\Test\SectionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestQuestionController;
use App\Http\Resources\AuthTokenResource;
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
    Route::apiResource("/brand", BrandManage::class);
});

Route::group(['middleware' => ['role:super-admin|manager']], function () {
    Route::apiResource("/elearn/test", TestController::class);
    Route::apiResource("/elearn/test/question/manage", TestQuestionController::class);
});

Route::group(['middleware' => ['role:super-admin|manager|staff']], function () {
    Route::get('/user', function (Request $request) {
        return response(new AuthTokenResource($request->user), 200);
    });
});

Route::post("/user/login", [AuthenticationController::class, "login"]);

Route::group(['middleware' => ['role:super-admin|manager']], function () {

    // Route::apiResource("/mall", MallManage::class, ["only" => ["index", "show"]]);
    // Route::apiResource("/store", StoreManage::class, ["only" => ["index", "show"]]);
    
    Route::apiResource("/staff", Manage::class);
    Route::apiResource("/elearn/{test_uuid}/test-section", SectionController::class)->middleware("test_uuid");
});