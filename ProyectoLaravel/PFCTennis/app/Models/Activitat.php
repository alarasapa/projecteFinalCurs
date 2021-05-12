<?php
    namespace App\Models;
    
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Models\Calendari;

    class Activitat {

        public $id;

        public $idTipusActivitat;

        public $titol;

        public $descripcio;

        /**
         * @var boolean 
         */
        public $formulari;

        /**
         * @var Calendari 
         */
        public $calendari;

        public function __construct($args = []){
            if (empty($args)) return $this;
            
            $this->setId($args[0]->id);
            $this->setTitol($args[0]->titol);
            $this->setDescripcio($args[0]->descripcio);
            $this->setFormulari($args[0]->formulari);
            $this->setIdTipusActivitat($args[0]->idTipusActivitat);
            // $this->setCalendari($args[0]->calendari);
        }

        public function getId(){
            return $this->id;
        }

        public function getTitol(){
            return $this->titol;
        }

        public function getDescripcio(){
            return $this->descripcio;
        }

        public function getFormulari(){
            return $this->formulari;
        }

        public function getCalendari(){
            return $this->calendari;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setIdTipusActivitat($idTipusActivitat){
            $this->idTipusActivitat = $idTipusActivitat;
            return $this;
        }

        public function setTitol($titol){
            $this->titol = $titol;
            return $this;
        }

        public function setDescripcio($descripcio){
            $this->descripcio = $descripcio;
            return $this;
        }

        public function setFormulari($formulari){
            if ($formulari == null)
                $this->formulari = 0;
            else 
                $this->formulari = 1;

            return $this;
        }        

        public function setCalendari($calendari){
            $this->calendari = $calendari;
            return $this;
        }
    }