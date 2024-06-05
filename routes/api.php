<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('checklists', [ChecklistController::class, 'index']);
        Route::post('checklists', [ChecklistController::class, 'store']);
        Route::delete('checklists/{id}', [ChecklistController::class, 'delete']);

        Route::get('checklists/{id}/item', [ChecklistItemController::class, 'index']);
        Route::get('checklists/{id}/item/{itemId}', [ChecklistItemController::class, 'show']);
        Route::post('checklists/{id}/item', [ChecklistItemController::class, 'store']);
        Route::put('checklists/{id}/item/{item_id}', [ChecklistItemController::class, 'check']);
        Route::put('checklists/{id}/item/rename/{item_id}', [ChecklistItemController::class, 'update']);
        Route::delete('checklists/{id}/item/{item_id}', [ChecklistItemController::class, 'delete']);
    });
});