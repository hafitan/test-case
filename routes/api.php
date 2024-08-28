<?php

use App\Http\Controllers\AccountsController;
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

Route::get('/home/api', [AccountsController::class, 'index']);
Route::post('/home/store/api', [AccountsController::class, 'store']);
Route::get('/subdistrict/api/{districtId}', [AccountsController::class, 'getSubdistricts']);
Route::get('/ward/api/{subdistrictId}', [AccountsController::class, 'getWards']);
Route::put('approval/api/{account_id}', [AccountsController::class, 'updateApproval']);
