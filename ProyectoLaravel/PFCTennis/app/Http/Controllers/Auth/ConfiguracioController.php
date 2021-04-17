<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuari;

class ConfiguracioController extends Controller {

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    protected function cambiarDades(Request $request){
        $usuari = new Usuari([$request]);
        
        DB::update('UPDATE usuari 
                SET nom = ?, cognoms = ?,
                email = ?, telefon = ?, dataNaixement = ?', 
        [$usuari->nom, $usuari->cognoms, $usuari->email, $usuari->telefon, $usuari->dataNaixement]);

        $descripcio = $usuari->nom . " ha cambiat les seves dades";
        $dataActualitzacio = date('Y-m-d H:i:s');
        DB::insert('INSERT INTO log_usuari(idUsuari, descripcio, data) VALUES(?, ?, ?)',
                                        [$usuari->id, $descripcio, $dataActualitzacio]);

        return redirect("/index");
    }

    protected function comprovar(Request $request){
        $email = $request->valor;
        $emailActual = $request->emailActual;

        $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari 
             WHERE email = ? AND email != ?', [$email, $emailActual]);
        
        echo $res[0]->resultat;
    }
}
