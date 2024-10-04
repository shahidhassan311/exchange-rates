<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::middleware('currency')->group(function () {
    Route::get('/currencies', [CurrencyController::class, 'index']);
    Route::get('/currencies/{id}', [CurrencyController::class, 'show']);
    Route::get('/currencies/{id}/history', [CurrencyController::class, 'history']);
});
