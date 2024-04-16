<?php

use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Message\MessageController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->post('/items', ItemController::class . '@store');
Route::middleware(['auth:sanctum'])->get('/items', ItemController::class . '@index');
Route::middleware(['auth:sanctum'])->post('/messages', MessageController::class . '@store');
Route::middleware(['auth:sanctum'])->get('/lost-items', ItemController::class . '@getLostItems');
Route::middleware(['auth:sanctum'])->get('/found-items', ItemController::class . '@getFoundItems');
Route::middleware(['auth:sanctum'])->get('/messages/{id}', MessageController::class . '@history');
