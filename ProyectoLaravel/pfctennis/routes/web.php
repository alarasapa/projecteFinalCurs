<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivitatController;
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
    Route::get('/dashboard/gestio/activitats/', [ActivitatController::class, 'gestioActivitats'])->name('activitats.activitats');
    Route::get('/dashboard/gestio/activitats/formulari/{accio}/{id?}', [ActivitatController::class, 'formulariActivitat'])->name('activitats.activitat.formulari');
    
    Route::post('/dashboard/gestio/activitats/afegir', [ActivitatController::class, 'insertarActivitat'])->name('activitats.activitat.afegir');
    Route::post('/dashboard/gestio/activitats/modificar', [ActivitatController::class, 'updateActivitat'])->name('activitats.activitat.modificar');
    Route::post('/dashboard/gestio/activitats/eliminar/{id}', [ActivitatController::class, 'eliminarActivitat'])->name('activitats.activitat.eliminar');
    
    // RUTES EXTRES
    Route::get('/dashboard/gestio/activitats/extres', [ActivitatController::class, 'gestioExtres'])->name('activitats.extres');
    Route::get('/dashboard/gestio/activitats/extres/{accio}/{id?}', [ActivitatController::class, 'formulariExtra'])->name('activitats.extres.formulari');
    
    Route::post('/dashboard/gestio/activitats/extres/afegir', [ActivitatController::class, 'insertarExtra'])->name('activitats.extres.afegir');
    Route::post('/dashboard/gestio/activitats/extres/modificar', [ActivitatController::class, 'updateExtra'])->name('activitats.extres.modificar');
    Route::post('/dashboard/gestio/activitats/extres/eliminar/{id}', [ActivitatController::class, 'eliminarExtra'])->name('activitats.extres.eliminar');
    
    // RUTES GRUPS OPCIONS
    Route::get('/dashboard/gestio/activitats/grup/{tipus}', [ActivitatController::class, 'gestioGrupOpcions'])->name('activitats.grupopcions');
    Route::get('/dashboard/gestio/activitats/grup-opcions/{idActivitat}', [ActivitatController::class, 'gestioGrupOpcionsActivitat'])->name('activitats.activitats.grupopcions');
    Route::get('/dashboard/gestio/activitats/grup/{tipus}/formulari/{accio}/{id?}', [ActivitatController::class, 'formulariGrupOpcio'])->name('activitats.grupopcions.formulari');
    
    Route::post('/dashboard/gestio/activitats/grup/{tipus}/afegir', [ActivitatController::class, 'insertarGrupOpcions'])->name('activitats.grupopcions.afegir');
    Route::post('/dashboard/gestio/activitats/grup/{tipus}/modificar', [ActivitatController::class, 'updateGrupOpcions'])->name('activitats.grupopcions.modificar');
    Route::post('/dashboard/gestio/activitats/grup/{tipus}/eliminar/{id}', [ActivitatController::class, 'eliminarGrupOpcions'])->name('activitats.grupopcions.eliminar');
    
    // RUTES OPCIONS
    Route::get('/dashboard/gestio/activitats/opcio/{idGrupOpcio}/{tipus}', [ActivitatController::class, 'gestioOpcions'])->name('activitats.opcions');
    Route::get('/dashboard/gestio/activitats/opcio/{idGrupOpcio}/{tipus}/formulari/{accio}/{id?}', [ActivitatController::class, 'formulariOpcio'])->name('activitats.opcions.formulari');
    
    Route::post('/dashboard/gestio/activitats/opcio/{tipus}/afegir', [ActivitatController::class, 'insertarOpcio'])->name('activitats.opcions.afegir');
    Route::post('/dashboard/gestio/activitats/opcio/{tipus}/modificar', [ActivitatController::class, 'updateOpcio'])->name('activitats.opcions.modificar');
    Route::post('/dashboard/gestio/activitats/opcio/{tipus}/eliminar/{id}/{idGrupOpcio}', [ActivitatController::class, 'eliminarOpcio'])->name('activitats.opcions.eliminar');
});

Auth::routes(['verify' => true]);