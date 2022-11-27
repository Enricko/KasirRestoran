<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[App\Http\Controllers\FrontController::class,'index']);
Route::post('/create_pesanan',[App\Http\Controllers\FrontController::class,'create_pesanan']);
Route::get('/pesanan/{id_pesanan}',[App\Http\Controllers\FrontController::class,'pesanan']);
Route::post('/add_pesanan',[App\Http\Controllers\FrontController::class,'add_pesanan']);
Route::get('/remove_pesanan',[App\Http\Controllers\FrontController::class,'remove_pesanan']);
Route::get('/list_pesanan',[App\Http\Controllers\FrontController::class,'list_pesanan']);
Route::get('/search_makanan',[App\Http\Controllers\FrontController::class,'search_makanan']);
Route::get('/search_minuman',[App\Http\Controllers\FrontController::class,'search_minuman']);
Route::get('/select_masakan',[App\Http\Controllers\FrontController::class,'select_masakan']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/',[App\Http\Controllers\AdminController::class,'index']);

    // === MASAKAN ===
    Route::get('/masakan',[App\Http\Controllers\MasakanController::class,'index']);
    Route::get('/tambah_masakan',[App\Http\Controllers\MasakanController::class,'tambah']);
    Route::post('/tambah_data_masakan',[App\Http\Controllers\MasakanController::class,'tambah_data']);
    Route::post('/status_masakan',[App\Http\Controllers\MasakanController::class,'status_masakan']);
    Route::get('/edit_masakan/{id_masakan}',[App\Http\Controllers\MasakanController::class,'edit']);
    Route::post('/edit_data_masakan/{id_masakan}',[App\Http\Controllers\MasakanController::class,'edit_data']);
    Route::get('/delete_masakan/{id_masakan}',[App\Http\Controllers\MasakanController::class,'delete']);
    // === MASAKAN ===

    // === MEJA ===
    Route::get('/meja',[App\Http\Controllers\MejaController::class,'index']);
    Route::get('/tambah_meja',[App\Http\Controllers\MejaController::class,'tambah']);
    Route::get('/delete_meja/{no_meja}',[App\Http\Controllers\MejaController::class,'delete']);
    // === MEJA ===
});