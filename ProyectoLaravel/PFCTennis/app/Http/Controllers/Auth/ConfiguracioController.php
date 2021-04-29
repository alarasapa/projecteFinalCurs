<?php

namespace App\Http\Controllers\Auth;

use App\Models\ConfiguracioDAO;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuari;

class ConfiguracioController extends Controller {

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    protected function cambiarDades(Request $request){
        // Cridem la funció per a cambiar les dades
        ConfiguracioDAO::cambiarDades($request);

        // Redireccionem al index
        return redirect("home")->with('status', 'S\'han cambiat les teves dades amb èxit!');
    }

    protected function comprovar(Request $request){
        // Retornem si ja existeix o no el que sigui que 
        // s'estigui comprovant del formulari 
        echo ConfiguracioDAO::comprovar($request);
    }

    protected function cambiarPassword(Request $request){
        // Cridem la funció per a cambiar la contrasenya
        ConfiguracioDAO::cambiarPassword($request);
        
        // Redireccionem 
        return redirect('cambiarPassword')->with('status', 'S\'ha cambiat la contrasenya amb èxit!');

    }
}
