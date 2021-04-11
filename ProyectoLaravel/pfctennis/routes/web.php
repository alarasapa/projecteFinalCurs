<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('index');
});

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/soci', [HomeController::class, 'soci'])->name('soci');
Route::get('/reservar', [HomeController::class, 'reservar'])->name('reservar');
Route::get('/escola', [HomeController::class, 'escola'])->name('escola');
Route::get('/casal', [HomeController::class, 'casal'])->name('casal');
Route::get('/contacte', [HomeController::class, 'contacte'])->name('contacte');

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registrarse', [HomeController::class, 'registrarse'])->name('registrarse');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();