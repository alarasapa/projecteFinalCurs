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
            'nom'         => ['required', 'string', 'max:45'],
            'cognoms'     => ['required', 'string', 'max:70'],
            'contrasenya' => ['required', 'string', 'min:8', 'confirmed'],
            'nickname'    => ['required', 'string', 'max:45', 'unique:usuari'],
            'email'       => ['required', 'string', 'email', 'max:45', 'unique:usuari'],
            'telefon'     => ['required', 'string', 'max:12']
        ]);
    }

    /**
     * Crear un usuari
     *
     * @param  array  $data
     * @return \App\Models\Usuari
     */
    protected function create(Request $request)
    {
        $nom           = $request->nom;
        $cognoms       = $request->cognoms;
        $nickname      = $request->nickname;
        $email         = $request->email;
        $contrasenya   = Hash::make($request->contrasenya);
        $telefon       = $request->telefon;
        $dataNaixement = $request->dataNaixement;
        $dataCreacio   = date('Y-m-d H:i:s');

        DB::insert('INSERT INTO usuari (nom, cognoms, nickname, email, contrasenya, telefon, dataNaixement, dataCreacio) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)', [$nom, $cognoms, $nickname, $email, $contrasenya, $telefon, $dataNaixement, $dataCreacio]);
        
        return view("index");        
    }
}
