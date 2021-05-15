<?php

namespace App\Http\Controllers;

use App\Mail\ContactaNosaltres;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ContacteController extends Controller
{
    public function send(Request $request){
        $data = [
            'nom' => $request->nom,
            'email' => $request->email,
            'missatge' => $request->missatge
        ];

        Mail::to('a.lara@sapalomera.cat')->send(new ContactaNosaltres($data));


        return response()->json([
        ], Response::HTTP_CREATED);
    }
}
