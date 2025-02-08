<?php

use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegencyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [RegencyController::class, 'index'])->name('regency');
Route::post('/regency', [RegencyController::class, 'store'])->name('regency.store');
Route::delete('/regency/{id}', [RegencyController::class, 'destroy'])->name('regency.destroy');
Route::get('/regency/export', [RegencyController::class, 'export'])->name('regency.export');

Route::get('/province', [ProvinceController::class, 'index'])->name('province');
Route::post('/province', [ProvinceController::class, 'store'])->name('province.store');
Route::get('/province/{id}', [ProvinceController::class, 'edit'])->name('province.edit');
Route::put('/province/{id}', [ProvinceController::class, 'update'])->name('province.update');
Route::delete('/province/{id}', [ProvinceController::class, 'destroy'])->name('province.destroy');