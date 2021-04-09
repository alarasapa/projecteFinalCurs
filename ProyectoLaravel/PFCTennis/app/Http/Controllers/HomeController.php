<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('index');
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
}
