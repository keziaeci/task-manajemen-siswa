<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
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


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::controller(MuridController::class)->group(function() {
        Route::get('/murids', 'index')->name('murid');
    });

    Route::controller(KelasController::class)->group(function() {
        Route::get('/kelas', 'index')->name('kelas');
        Route::get('/kelas/{kelas}', 'show')->name('kelas-show');
        Route::patch('/kelas/{kelas}', 'update')->name('kelas-update');
        Route::delete('/kelas/{kelas}', 'destroy')->name('kelas-destroy');
        Route::post('/kelas', 'store')->name('kelas-store');
    });

    Route::controller(GuruController::class)->group(function() {
        Route::get('/gurus', 'index')->name('guru');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'authenticate')->name('auth');
    });
});
