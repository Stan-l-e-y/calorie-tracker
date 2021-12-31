<?php

use App\Http\Controllers\DaysController;
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

Route::get('/table-show', [DaysController::class, 'apiIndex']);
// ->middleware(['auth'])->name('table-show');

Route::prefix('/table')->group(function () {
    Route::post('/store', [DaysController::class, 'store']);
    Route::put('/{id}', [DaysController::class, 'update']);
});
