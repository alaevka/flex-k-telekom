<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\EquipmentTypeController;

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

Route::apiResource('equipment', EquipmentController::class)
    ->middleware('jwt')
;
Route::apiResource('equipment-type', EquipmentTypeController::class)
    ->only('index')
    //->middleware('jwt')
;
