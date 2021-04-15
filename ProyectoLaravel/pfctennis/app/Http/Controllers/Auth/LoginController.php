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

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->user =  Auth::user();
    }

    /**
     * Funció per a logearse en la pàgina web
     * 
     * @param Request $request Informació del usuari que es vol logar
     */
    public function login(Request $request){
        //Nom o correu del usuari
        $email = $request->usuariEmail;
        //La contrasenya enviada, encriptada amb MD5
        $contrasenya = hash('md5', $request->password);

        //Senténcia SQL on es buscarà l'usuari
        $res = DB::select('SELECT * FROM usuari  
                    WHERE contrasenya = ? AND email = ?',
                    [$contrasenya, $email]);
        
        //Si el resultat de la búsqueda retorna res -> redirigeix de nou al login
        if (!empty($res)) {
            //En cas contrari, crea un objecte Usuari...
            $usuari = new Usuari($res);
            //...y es logeja amb aquest objecte
            Auth::login($usuari);
            
            //Per últim redirigeix al index
            return redirect("/index");            
        } 
        else return view("auth.login");
    }
}
