<?php

namespace App\Http\Controllers;

use App\Models\ObjecteVista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuari;
use App\Models\Log;
use App\Models\HomeDAO;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Redirigen a la vista especificada
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        // Recuperem els sliders de la BBDD
        $sliders = [];
        $sliders = HomeDAO::getSliders();

        // Recuperem les cartes de la BBDD
        $cartes = [];
        $cartes = HomeDAO::getCartes();

        return view('index', compact('sliders', 'cartes'));
    }
    
    public function soci()
    {
        return view('ClientVista.soci');
    }

    public function reservar()
    {
        return view('ClientVista.reservar');
    }

    public function escola()
    {
        return view('ClientVista.escola');
    }

    public function casal()
    {
        return view('ClientVista.casal');
    }

    public function contacte()
    {
        return view('ClientVista.contacte');
    }

    public function home(){
        return view('ClientVista.home');
    }
    public function cambiarPassword(){
        return view('ClientVista.cambiarpassword');
    }

    /***
     * FUNCIONES DE AUTENTIFICACIÓN
     */
    public function login(){
        return view('auth.login');
    }
    public function registrarse(){
        return view('auth.register');
    }
    public function resetear(){
        return view('auth.passwords.reset');
    }
}