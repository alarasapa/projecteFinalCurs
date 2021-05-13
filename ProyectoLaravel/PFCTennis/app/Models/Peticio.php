<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Models\Usuari;
    use App\Models\Activitat;
    //TODO CONTINUAR CREANDO EL OBJETO DE PETICIÓNS
    class Peticio {

        public $id;

        public $usuari;

        public $activitat;

        public $dadesPeticio;

        public $pagat;

        public function __construct($args = []){

        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }
    }