<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ObjecteVista;
use App\Models\Usuari;
use App\Models\Log;
use App\Models\HomeDAO;
use App\Models\AuthDAO;


class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Redireccionen a la vista especificada
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        // Recuperem els sliders de la BBDD
        $sliders = [];
        $sliders = HomeDAO::getLlistatObjecteVista('inici_vista');

        // Recuperem les cartes de la BBDD
        $cartes = [];
        $cartes = HomeDAO::getLlistatObjecteVista('cartes_inici_vista');

        // Retirnem
        return view('index', compact('sliders', 'cartes'));
    }
    
    public function soci()
    {
        $tipusSocis = [];
        $tipusSocis = HomeDAO::getTipusSoci();

        return view('ClientVista.soci', compact('tipusSocis'));
    }

    public function reservar()
    {
        return view('ClientVista.reservar');
    }

    public function escola()
    {
        $escoles = HomeDAO::getActivitats('escola');
        
        return view('ClientVista.escola', ['activitats' => $escoles]);
    }

    public function casal()
    {
        $casals = HomeDAO::getActivitats('casal');

        return view('ClientVista.casal', ['activitats' => $casals]);
    }

    public function contacte()
    {
        return view('ClientVista.contacte');
    }

    public function home(){
        return view('ClientVista.home');
    }
    public function cambiarLocalitzacio(){
        $localitzacio = AuthDAO::getLocalitzacio(Auth::user()->id);

        return view('ClientVista.cambiarLocalitzacio', compact('localitzacio'));
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