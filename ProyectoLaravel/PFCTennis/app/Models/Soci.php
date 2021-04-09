<?php
    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Soci extends Usuari {

        /**
         * @var DateTime
         */
        private $dataInscripcio;

        public function __constructor(){}

        //AQUÍ IRÁN OTRAS FUNCIONES, SI HACEN FALTA CLARO

        /********************
         * GETTER Y SETTERS *
         ********************/
        
        public function getDataInscripcio(){
            return $this->dataInscripcio;
        }

        public function setDataInscripcio($dataInscripcio){
            $this->dataInscripcio = $dataInscripcio;
        }
    }
?>