<?php

namespace App\Http\Controllers;

use App\Models\ObjecteVista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuari;
use App\Models\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $res = DB::select('SELECT * FROM inici_vista');
        
        foreach ($res as $slider){
            $obj = new ObjecteVista($slider);
            $sliders[] = $obj;
        }

        // Recuperem les cartes de la BBDD
        $cartes = [];
        $res = DB::select('SELECT * FROM cartes_inici_vista');
        
        foreach ($res as $carta){
            $obj = new ObjecteVista($carta);
            $cartes[] = $obj;
        }

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


    public function dashboard(){
        $logsUsuaris = [];
        $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.telefon, u.dataNaixement, u.dataCreacio 
            FROM log_usuari lg INNER JOIN usuari u ON lg.idUsuari = u.id ORDER BY lg.data');

        foreach ($res as $log){
            $usuariObj = new Usuari(array($log));
            $logObj = new Log($log, $usuariObj);
            $logsUsuaris[] = $logObj;
        }

        return view('AdminVista.dashboard', compact('logsUsuaris'));
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