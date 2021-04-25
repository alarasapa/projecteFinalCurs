<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class ObjecteVista {

        /**
         * @var Integer
         */
        public $id; 

        /**
         * @var String
         */
        public $titol;

        /**
         * @var String
         */
        public $descripcio;

        /**
         * @var String
         */
        public $imatge;
        
        public function __construct($args = []){
            if (empty($args)) return $this;
            $this->setId($args->id);
            $this->setTitol($args->titol);
            $this->setDescripcio($args->descripcio);
            $this->setImatge($args->imatge);
        }

        /********************
         * GETTER Y SETTERS *
         ********************/

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getTitol(){
            return $this->titol;
        }

        public function setTitol($titol){
            $this->titol = filter_var($titol, FILTER_SANITIZE_STRING);
            return $this;
        }

        public function getDescripcio(){
            return $this->descripcio;
        }

        public function setDescripcio($descripcio){
            $this->descripcio = filter_var($descripcio, FILTER_SANITIZE_STRING);
            return $this;
        }

        public function getImatge(){
            return $this->imatge;
        }

        public function setImatge($imatge){
            $this->imatge = filter_var($imatge, FILTER_SANITIZE_STRING);
            return $this;
        }
    }