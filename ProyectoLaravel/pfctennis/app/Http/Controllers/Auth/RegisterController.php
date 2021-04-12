<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Usuari;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
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
     * @return \App\Models\Usuari
     */
    protected function create(Request $request)
    {  
        $data = [];
        
        $data['nom']           = $request->nom;
        $data['cognoms']       = $request->cognoms;
        $data['nickname']      = $request->nickname;
        $data['email']         = $request->email;
        $data['contrasenya']   = Hash::make($request->contrasenya);
        $data['telefon']       = $request->telefon;
        $data['dataNaixement'] = $request->dataNaixement;
       
        // $validator = validator($data);
        $data['dataCreacio']   = date('Y-m-d H:i:s');
        
        DB::insert('INSERT INTO usuari (nom, cognoms, nickname, email, contrasenya, telefon, dataNaixement, dataCreacio) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)', [$nom, $cognoms, $nickname, $email, $contrasenya, $telefon, $dataNaixement, $dataCreacio]);
        
        return view("index");        
    }

    protected function comprovar(Request $request){
        echo "lmcsoacmas " . $request;
        //DB::select()
    }
}
