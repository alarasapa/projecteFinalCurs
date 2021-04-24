<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Providers\RouteServiceProvider;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Http\Request;
    use App\Models\AuthDAO;
    use App\Models\Usuari;

    class RegisterController extends Controller
    {

        use RegistersUsers;

        protected $redirectTo = RouteServiceProvider::HOME;

        public function __construct()
        {
            //$this->middleware('guest');
        }

        /**
         * Crear un usuari
         *
         * @param  Illuminate\Http\Request $request Dades del formulari
         * 
         * @return Route Redirecciona a la vista
         */
        protected function create(Request $request) {  
            // Afegim l'usuari a la BBDD
            $usuari = AuthDAO::insertarUsuari($request);
            
            // Iniciem sessió automàticament amb aquest usuari y...
            Auth::login($usuari);
            
            // Redireccionem al index
            return redirect("index");        
        }

        protected function comprovar(Request $request){
            // Comprovem les dades del formulari
            echo AuthDAO::comprovar($request);
        }

        /**
         * Funció per a obtenir l'identificador del usuari en base al email
         * 
         * @param String $email Correu electrónic
         */
        protected function obtenirId($email){

            return AuthDAO::obtenirId($email);
        }
    }