<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('/', [LoginController::class, 'getLogin']);
Route::middleware('auth')->group(function () {
    Route::get('/home', [AccountsController::class, 'index'])->name('index');
    Route::post('/accounts/store', [AccountsController::class, 'store'])->name('accounts.store');
    Route::get('/get-districts/{provinceId}', [AccountsController::class, 'getDistricts']);
    Route::get('/get-subdistricts/{districtId}', [AccountsController::class, 'getSubdistricts']);
    Route::get('/get-ward/{subdistrictId}', [AccountsController::class, 'getWards']);
    Route::put('/update/approval/{account_id}', [AccountsController::class, 'updateApproval'])->name('update.approval.updateId');
});