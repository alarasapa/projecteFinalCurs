<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Slider {

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
        
        public function __construct($args){
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
            $this->titol = $titol;
            return $this;
        }

        public function getDescripcio(){
            return $this->descripcio;
        }

        public function setDescripcio($descripcio){
            $this->descripcio = $descripcio;
            return $this;
        }

        public function getImatge(){
            return $this->imatge;
        }

        public function setImatge($imatge){
            $this->imatge = $imatge;
            return $this;
        }
    }