<?php

use App\Http\Controllers\FruitController;
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

Route::get('/get-fruits', [FruitController::class, 'index'])->name('api.fruits.index');
Route::patch('/update-nesting', [FruitController::class, 'updateNesting'])->name('api.nesting.update');
Route::patch('/update-fruit/{fruit}', [FruitController::class, 'updateFruit'])->name('api.fruit.update');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
