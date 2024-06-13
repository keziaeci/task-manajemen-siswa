<?php

use App\Models\Murid;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;

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
        return view('home',[
            'murids' => Murid::filter(request('filter'))->all()
        ]);
    })->name('home');

    Route::controller(KelasController::class)->group(function() {
        Route::get('/kelas', 'index')->name('kelas');
        Route::get('/kelas/{kelas}', 'show')->name('kelas-show');
        Route::patch('/kelas/{kelas}', 'update')->name('kelas-update');
        Route::delete('/kelas/{kelas}', 'destroy')->name('kelas-destroy');
        Route::post('/kelas', 'store')->name('kelas-store');
    });

    Route::controller(MuridController::class)->group(function() {
        Route::get('/murids', 'index')->name('murids');
        Route::get('/murids/search', 'search')->name('murid-search');
        Route::get('/murid/create', 'create')->name('murid-create');
        Route::get('/murid/{murid}', 'edit')->name('murid-edit');
        Route::patch('/murid/{murid}', 'update')->name('murid-update');
        Route::delete('/murid/{murid}', 'destroy')->name('murid-destroy');
        Route::post('/murid', 'store')->name('murid-store');
    });

    Route::controller(GuruController::class)->group(function() {
        Route::get('/gurus', 'index')->name('gurus');
        Route::get('/guru/create', 'create')->name('guru-create');
        Route::get('/guru/{guru}', 'edit')->name('guru-edit');
        Route::patch('/guru/{guru}', 'update')->name('guru-update');
        Route::delete('/guru/{guru}', 'destroy')->name('guru-destroy');
        Route::post('/guru', 'store')->name('guru-store');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'authenticate')->name('auth');
    });
});
