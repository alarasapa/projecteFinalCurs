<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ConfiguracioController;

// RUTAS (GENERAL) REDIRECCIONAMIENTO 
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/index', [HomeController::class, 'index'])->name('index');

Route::get('/soci', [HomeController::class, 'soci'])->name('soci');
Route::get('/reservar', [HomeController::class, 'reservar'])->name('reservar');
Route::get('/escola', [HomeController::class, 'escola'])->name('escola');
Route::get('/casal', [HomeController::class, 'casal'])->name('casal');
Route::get('/contacte', [HomeController::class, 'contacte'])->name('contacte');

// RUTAS (AUTH) REDIRECCIONAMIENTO
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registrarse', [HomeController::class, 'registrarse'])->name('registrarUsuari');
Route::get('/resetear', [HomeController::class, 'resetear'])->name('resetear');

// RUTAS PARA ADMINISTRADOR
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// GESTIÓ PÀGINES
Route::get('/dashboard/gestio/slider', [AdminController::class, 'getSliders'])->name('slider');
Route::get('/dashboard/gestio/carta', [AdminController::class, 'getCartes'])->name('carta');

Route::get('/dashboard/gestio/form/{accio}/{tipus}/{id?}', [AdminController::class, 'formulariVista'])->name('formulariVista');
Route::post('/dashboard/gestio/vista/insertar', [AdminController::class, 'insertarVista'])->name('insertarVista');

// GESTIÓ USUARIS
Route::get('/dashboard/gestio/usuaris', [AdminController::class, 'gestioUsuaris'])->name('gestioUsuaris');
Route::get('/dashboard/gestio/usuaris/{accio}/{id?}', [AdminController::class, 'formulariUsuari'])->name('formulariUsuari');
Route::post('/dashboard/gestio/usuaris/registrarse', [AdminController::class, 'registrar'])->name('registrarAdmin');
Route::post('/dashboard/gestio/usuaris/actualizar', [AdminController::class, 'actualizar'])->name('actualitzarUsuari');
Route::post('/dashboard/gestio/usuaris/eliminarUsuari/{id}', [AdminController::class, 'eliminar'])->name('eliminarUsuari');

// RUTAS PARA EL REGISTRO USUARIO
Route::post('/registrarse', [RegisterController::class, 'create'])->name('create');
Route::post('/registrarse/comprovar', [RegisterController::class, 'comprovar'])->name('comprovar');


// RUTAS PARA LOGIN
Route::post('/login', [LoginController::class], 'login')->name('login');

// RUTAS DE HOME "GET" \\
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/configuracio/cambiarpassword', [HomeController::class, 'cambiarPassword'])->name('cambiarPassword');
// RUTAS DE HOME "POST" \\
Route::post('/configuracio/cambiarpassword', [ConfiguracioController::class, 'cambiarPassword'])->name('cambiarPassword');
Route::post('/configuracio/cambiardades', [ConfiguracioController::class, 'cambiarDades'])->name('cambiarDades');
Route::post('/configuracio/comprovar', [ConfiguracioController::class, 'comprovar'])->name('comprovar');

Auth::routes();