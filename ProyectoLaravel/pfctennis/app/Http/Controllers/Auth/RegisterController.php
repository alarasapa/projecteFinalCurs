<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Usuari;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        //$this->middleware('guest');
    }

    protected function validador(array $data)
    {
        return Validator::make($data, [
            'nom'           => ['required', 'string', 'max:45'],
            'cognoms'       => ['required', 'string', 'max:70'],
            'contrasenya'   => ['required', 'string', 'min:8', 'confirmed'],
            'nickname'      => ['required', 'string', 'max:45', 'unique:usuari'],
            'email'         => ['required', 'string', 'email', 'max:45', 'unique:usuari'],
            'telefon'       => ['required', 'string', 'max:12'],
            'dataNaixement' => ['required', 'date']
        ]->validate());
    }

    /**
     * Crear un usuari
     *
     * @param  Illuminate\Http\Request $request Dades del formulari;
     * @return Route Redirecciona a la vista
     */
    protected function create(Request $request)
    {  
        // Obtenim les dades
        $nom           = filter_var($request->nom, FILTER_SANITIZE_STRING);
        $cognoms       = filter_var($request->cognoms, FILTER_SANITIZE_STRING);
        $email         = $request->email;
        $contrasenya   = filter_var($request->password, FILTER_SANITIZE_STRING);
        $contrasenya   = hash('md5', $contrasenya);
        $rol           = $request->rol;
        $telefon       = $request->telefon;
        $dataNaixement = $request->dataNaixement;
        $dataCreacio   = date('Y-m-d H:i:s');

        //Insertem l'usuari
        DB::insert('INSERT INTO usuari (nom, cognoms, email, contrasenya, rol, telefon, dataNaixement, dataCreacio) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)', [$nom, $cognoms, $email, $contrasenya, $rol, $telefon, $dataNaixement, $dataCreacio]);
        
        //Agafem y igualem al identificador
        $request->id = $this->obtenirId($email);
        //Creem l'objecte usuari
        $usuari = new Usuari([$request]);
        
        //Iniciem sessió automàticament amb aquest usuari y...
        Auth::login($usuari);
        //Redireccionem al index
        return redirect("/index");        
    }

    protected function comprovar(Request $request){
        $email = $request->valor;
        $emailActual = $request->emailActual;

        $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari WHERE email = ?', [$email]);
        
        echo $res[0]->resultat;
    }

    /**
     * Funció per a obtenir l'identificador del usuari en base al email
     * 
     * @param String $email Correu electrónic
     */
    protected function obtenirId($email){
        $res = DB::select("SELECT id FROM usuari WHERE email = ?", [$email]);
        
        return $res[0]->id;
    }
}