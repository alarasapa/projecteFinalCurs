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
        // $this->middleware(['auth');
        $this->middleware('guest')->except('logout');
        // $this->user =  Auth::user();
    }

    public function login(Request $request){
        $usuari      = $request->usuariEmail;
        $contrasenya = hash('md5', $request->password);

        $res = DB::select('SELECT * FROM usuari  
                    WHERE contrasenya = ? AND (nickname = ? OR email = ?)',
                    [$contrasenya, $usuari, $usuari]);
        
        if (!empty($res)){
            $usuari = new Usuari($res);
            Auth::login($usuari);
            
            return redirect("/index");            
        } 
        else return view("auth.login");
    }
}
