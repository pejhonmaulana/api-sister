<?php

use App\Http\Controllers\KontrakanController;
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

Route::get('/kontrakan', [KontrakanController::class, 'index']);
Route::get('/kontrakan/{id}', [KontrakanController::class, 'show']);
Route::post('/tambah-kontrakan', [KontrakanController::class, 'store']);
Route::post('/update-kontrakan/{id}', [KontrakanController::class, 'update']);
Route::delete('/delete-kontrakan/{id}', [KontrakanController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
