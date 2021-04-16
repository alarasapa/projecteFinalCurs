<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ConfiguracioController;

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
// Route::post('/index', [HomeController::class, 'index'])->name('index');

// RUTAS (GENERAL) REDIRECCIONAMIENTO 
Route::get('/soci', [HomeController::class, 'soci'])->name('soci');
Route::get('/reservar', [HomeController::class, 'reservar'])->name('reservar');
Route::get('/escola', [HomeController::class, 'escola'])->name('escola');
Route::get('/casal', [HomeController::class, 'casal'])->name('casal');
Route::get('/contacte', [HomeController::class, 'contacte'])->name('contacte');

// RUTAS (AUTH) REDIRECCIONAMIENTO
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registrarse', [HomeController::class, 'registrarse'])->name('registrarse');
Route::get('/resetear', [HomeController::class, 'resetear'])->name('resetear');

// RUTAS PARA EL REGISTRO USUARIO
Route::post('/registrarse', [RegisterController::class, 'create'])->name('create');
Route::post('/registrarse/comprovar', [RegisterController::class, 'comprovar'])->name('comprovar');

// RUTAS PARA LOGIN
Route::post('/login', [LoginController::class], 'login')->name('login');

// RUTAS DE HOME
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::post('/configuracio/cambiardades', [ConfiguracioController::class, 'cambiarDades'])->name('cambiarDades');

Auth::routes();