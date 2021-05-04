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
        public $dataInscripcio;

        public $tipusSoci;

        public function __constructor($args = []){
            $this->setDataInscripcio($args[0]->dataInscripcio);
            $this->setTipusSoci($args[0]->tipusSoci);
        }

        //AQUÍ IRÁN OTRAS FUNCIONES, SI HACEN FALTA CLARO

        /********************
         * GETTER Y SETTERS *
         ********************/
        
        public function getTipusSoci(){
            return $this->tipusSoci;
        }

        public function getDataInscripcio(){
            return $this->dataInscripcio;
        }

        public function setTipusSoci($tipusSoci){
            $this->tipusSoci = $tipusSoci;
            return $this;
        }

        public function setDataInscripcio($dataInscripcio){
            $this->dataInscripcio = $dataInscripcio;
        }
    }
?>