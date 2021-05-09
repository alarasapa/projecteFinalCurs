<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Opcio {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $nom;
    
    /**
     * @var float
     */
    public $preu;

    /**
     * @var float
     */
    public $preuSoci;
    
    /**
     * @var string
     */
    public $tipus;

    public function __construct($args = []){
        if (empty($args)) return $this;

        $this->setId($args[0]->id);
        $this->setNom($args[0]->nom);
        $this->setPreu($args[0]->preu);
        $this->setPreuSoci($args[0]->preuSoci);
        $this->setTipus($args[0]->tipus);
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    public function setPreu($preu){
        $this->preu = $preu;
        return $this;
    }

    public function setPreuSoci($preuSoci){
        $this->preuSoci = $preuSoci;
        return $this;
    }

    public function setTipus($tipus){
        $this->tipus = $tipus;
        return $this;
    }
}