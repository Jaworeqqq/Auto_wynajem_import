<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
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

Route::get('/samochody',   [CarController::class, 'index'])->name('cars.index');
Route::get('/samochody/{slug}', [CarController::class, 'show'])->name('cars.show');
