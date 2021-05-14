<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Models\Usuari;
    use App\Models\Activitat;

    class Peticio {

        public $id;

        /**
         * @var Usuari
         */
        public $usuari;

        /**
         * @var Activitat
         */
        public $activitat;

        public $dadesPeticio;

        public $pagat;

        public $dataPeticio;

        public function __construct($args = []){
            $this->setId($args[0]->id);
            // $this->setUsuari($args[0]->usuari);
            // $this->setActivitat($args[0]->activitat);
            $this->setDadesPeticio($args[0]->dadesPeticio);
            $this->setPagat($args[0]->pagat);
            $this->setDataPeticio($args[0]->dataPeticio);
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setUsuari($usuari){
            $this->usuari = $usuari;
            return $this;
        }

        public function setActivitat($activitat){
            $this->activitat = $activitat;
            return $this;
        }

        public function setDadesPeticio($dadesPeticio){
            $this->dadesPeticio = json_decode($dadesPeticio, true);
            return $this;
        }

        public function setPagat($pagat){
            if ($pagat == 0) $this->pagat = false;
            else $this->pagat = true;
            
            return $this;
        }

        public function setDataPeticio($dataPeticio){
            $this->dataPeticio = $dataPeticio;
            return $this;
        }
    }