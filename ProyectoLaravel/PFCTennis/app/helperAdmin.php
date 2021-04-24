<?php

    function rutaActual($ruta){
        return request()->is($ruta) ? 'active' : '';
    }

?>