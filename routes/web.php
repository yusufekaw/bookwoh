<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\TuanrumahController::class, 'index'])->name('home');
Route::get('/tuanrumah', [App\Http\Controllers\TuanrumahController::class, 'index'])->name('tuanrumah');
Route::get('/tuanrumah/register', [App\Http\Controllers\TuanrumahController::class, 'create'])->name('tuanrumah/register');
Route::post('/tuanrumah/simpan', [App\Http\Controllers\TuanrumahController::class, 'store'])->name('tuanrumah/simpan');
Route::post('/tuanrumah/update/{id}', [App\Http\Controllers\TuanrumahController::class, 'update'])->name('tuanrumah/update/{id}');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::post('/user/simpan', [App\Http\Controllers\UserController::class, 'store'])->name('user/simpan');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user/edit/{id}');
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user/update/{id}');
Route::get('/user/hapus/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user/hapus/{id}');

Route::get('/dashboard', [App\Http\Controllers\TamuController::class, 'index'])->name('dashboard');

Route::post('/tamu/simpan', [App\Http\Controllers\TamuController::class, 'store'])->name('tamu/simpan');
Route::get('/tamu/{id}', [App\Http\Controllers\TamuController::class, 'show'])->name('tamu/{id}');
Route::get('/tamu/edit/{id}', [App\Http\Controllers\TamuController::class, 'edit'])->name('tamu/edit/{id}');
Route::post('/tamu/update/{id}', [App\Http\Controllers\TamuController::class, 'update'])->name('tamu/update/{id}');
Route::get('/tamu/hapus/{id}', [App\Http\Controllers\TamuController::class, 'destroy'])->name('tamu/hapus/{id}');

Route::post('/kado/simpan', [App\Http\Controllers\KadoController::class, 'store'])->name('kado/simpan');
Route::get('/kado/edit/{id}', [App\Http\Controllers\KadoController::class, 'edit'])->name('kado/edit/{id}');
Route::post('/kado/update/{id}', [App\Http\Controllers\KadoController::class, 'update'])->name('kado/update/{id}');
Route::get('/kado/hapus/{id}', [App\Http\Controllers\KadoController::class, 'destroy'])->name('kado/hapus/{id}');

