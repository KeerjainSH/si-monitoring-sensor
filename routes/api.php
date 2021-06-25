<?php

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

Route::get('/fetchData', [App\Http\Controllers\API\APIController::class, 'fetchData'])->name('fetchData');

Route::get('/getGraphicData', [App\Http\Controllers\API\APIController::class, 'getGraphicData'])->name('getGraphicData') ;

Route::post('/addData', [App\Http\Controllers\API\APIController::class, 'addData'])->name('addData') ;

Route::post('/fetchExcel', [App\Http\Controllers\API\APIController::class, 'fetchDataExcel'])->name('syncExcel') ;

Route::get('/getStatus', [App\Http\Controllers\API\APIController::class, 'getStatus'])->name('getStatus');
