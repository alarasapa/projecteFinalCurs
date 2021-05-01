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
use App\Models\AuthDAO;

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
        request()->validate([
            "usuariEmail" => 'required',
            "password" => 'required',
        ]);
            
        $res = AuthDAO::login($request);

        // Si el resultat de la búsqueda retorna res -> redirigeix de nou al login
        if (!empty($res)) {
            // En cas contrari, crea un objecte Localitzacio...
            $localitzacio = AuthDAO::getLocalitzacio($res[0]->id);

            // I després d'usuari
            $usuari = new Usuari($res);
            $usuari->setLocalitzacio($localitzacio);

            //...y es logeja amb aquest objecte
            Auth::login($usuari);

            if (isAdmin()){
                return redirect('/dashboard');
            } else {
                //Per últim redirigeix al index
                return redirect("/index");            
            }
        } 
        else return redirect()->route("login")->with('status', 'Hi ha hagut un error amb l\'email o la contrasenya');
    }
}
