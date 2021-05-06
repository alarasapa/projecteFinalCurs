<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    
    class Extra {

        public $id;

        public $nom;

        public $preuSoci;
        
        public $preuNoSoci;

        public function __construct($args = []){
            if (empty($args)) return $this;
            $this->setId($args[0]->id);
            $this->setNom($args[0]->nom);
            $this->setPreuSoci($args[0]->preuSoci);
            $this->setNoPreuSoci($args[0]->preuNoSoci);
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setNom($nom){
            $this->nom = $nom;
            return $this;
        }

        public function setPreuSoci($preuSoci){
            $this->preuSoci = $preuSoci;
            return $this;
        }

        public function setNoPreuSoci($preuNoSoci){
            $this->preuNoSoci = $preuNoSoci;
            return $this;
        }

    }