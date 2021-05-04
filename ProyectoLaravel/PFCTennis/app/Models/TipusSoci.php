<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class TipusSoci {

        public $id;

        public $nom;

        public $descripcio;

        public $preu;

        public function __construct($args = []){
            $this->setId($args->id);
            $this->setNom($args->nom);
            $this->setDescripcio($args->descripcio);
            $this->setPreu($args->preu);
        }

        public function getId(){
            return $this->id;
        }

        public function getNom(){
            return $this->nom;
        }

        public function getDescripcio(){
            return $this->descripcio;
        }

        public function getPreu(){
            return $this->preu;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setNom($nom){
            $this->nom = $nom;
            return $this;
        }

        public function setDescripcio($descripcio){
            $this->descripcio = $descripcio;
            return $this;
        }

        public function setPreu($preu){
            $this->preu = $preu;
            return $this;
        }
    }