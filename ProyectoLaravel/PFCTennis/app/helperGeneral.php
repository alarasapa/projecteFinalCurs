<?php

    function rutaActual($ruta){
        return request()->is($ruta) ? 'active' : '';
    }

    // function isAdmin(){
    //     return Auth::user()->rol == 'A';
    // }
?>