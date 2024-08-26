<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware(['api.auth'])->group(function() {
    Route::get('/home', [AccountsController::class, 'index'])->name('index');
    Route::post('/accounts/store', [AccountsController::class, 'store'])->name('accounts.store');

    // Routes untuk dropdown dinamis
    Route::get('/get-cities/{province}', [AccountsController::class, 'getCities']);
    Route::get('/get-districts/{city}', [AccountsController::class, 'getDistricts']);
    Route::get('/get-subdistricts/{district}', [AccountsController::class, 'getSubdistricts']);
// });