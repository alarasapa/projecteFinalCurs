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
Route::get('/activitats/reservar', [HomeController::class, 'reservar'])->name('activitats.reservar');
Route::get('/activitats/escola', [HomeController::class, 'escola'])->name('activitats.escola');
Route::get('/activitats/casal', [HomeController::class, 'casal'])->name('activitats.casal');
Route::get('/contacte', [HomeController::class, 'contacte'])->name('contacte');

// RUTAS (AUTH) REDIRECCIONAMIENTO
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registrarse', [HomeController::class, 'registrarse'])->name('registrarUsuari');
Route::get('/resetear', [HomeController::class, 'resetear'])->name('resetear');

// RUTAS PARA EL REGISTRO USUARIO
Route::post('/registrarse', [RegisterController::class, 'create'])->name('create');
Route::post('/registrarse/comprovar', [RegisterController::class, 'comprovar'])->name('comprovar');

// RUTAS PARA LOGIN
Route::post('/login', [LoginController::class], 'login')->name('login');

Route::middleware('verified')->group(function(){
    Route::post('/soci/apuntarse', [AdminController::class, 'enviarPeticio'])->name('apuntarseSoci');
    
    // RUTAS DE HOME "GET" \\
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/configuracio/cambiarlocalitzacio', [HomeController::class, 'cambiarLocalitzacio'])->name('cambiarLocalitzacio');
    Route::get('/configuracio/cambiarpassword', [HomeController::class, 'cambiarPassword'])->name('cambiarPassword');
    
    // RUTAS DE HOME "POST" \\
    Route::post('/configuracio/cambiardades', [ConfiguracioController::class, 'cambiarDades'])->name('cambiarDades');
    Route::post('/configuracio/cambiarlocalitzacio', [ConfiguracioController::class, 'cambiarLocalitzacio'])->name('cambiarLocalitzacio');
    Route::post('/configuracio/cambiarpassword', [ConfiguracioController::class, 'cambiarPassword'])->name('cambiarPassword');
    Route::post('/configuracio/comprovar', [ConfiguracioController::class, 'comprovar'])->name('comprovar');
    
    // RUTAS PARA ADMINISTRADOR
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // GESTIÓ PÀGINES
    Route::get('/dashboard/gestio/vista/slider', [AdminController::class, 'getSliders'])->name('slider');
    Route::get('/dashboard/gestio/vista/cartes', [AdminController::class, 'getCartes'])->name('cartes');

    Route::get('/dashboard/gestio/form/{accio}/{tipus}/{id?}', [AdminController::class, 'formulariVista'])->name('formulariVista');
    Route::post('/dashboard/gestio/vista/insertar', [AdminController::class, 'insertarVista'])->name('insertarVista');
    Route::post('/dashboard/gestio/vista/actualizar', [AdminController::class, 'actualizarVista'])->name('actualitzarVista');
    Route::post('/dashboard/gestio/vista/eliminar/{tipus}/{id}', [AdminController::class, 'eliminarVista'])->name('eliminarVista');

    // GESTIÓ USUARIS
    Route::get('/dashboard/gestio/usuaris', [AdminController::class, 'gestioUsuaris'])->name('usuaris.gestioUsuaris');
    Route::get('/dashboard/gestio/usuaris/{accio}/{id?}', [AdminController::class, 'formulariUsuari'])->name('usuaris.formulariUsuari');
    Route::post('/dashboard/gestio/usuaris/registrarse', [AdminController::class, 'registrar'])->name('registrarAdmin');
    Route::post('/dashboard/gestio/usuaris/actualizar', [AdminController::class, 'actualizar'])->name('actualitzarUsuari');
    Route::post('/dashboard/gestio/usuaris/eliminarUsuari/{id}', [AdminController::class, 'eliminar'])->name('eliminarUsuari');

    // RUTES ACTIVITATS
    Route::get('/dashboard/gestio/activitats/formulari/{accio}/{id?}', [AdminController::class, 'formulariActivitat'])->name('activitats.formulari');
    
    // RUTES EXTRES
    Route::get('/dashboard/gestio/activitats/extres', [AdminController::class, 'gestioExtres'])->name('activitats.extres');
    
});

Auth::routes(['verify' => true]);