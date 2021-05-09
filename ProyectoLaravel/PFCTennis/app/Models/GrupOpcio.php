<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Activitat;

class GrupOpcio {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var Activitat
     */
    public $activitat;

    /**
     * @var string
     */
    public $nom;

    /**
     * @var string
     */
    public $descripcio;

    /**
     * @var string {simple, complex}
     */
    public $tipus;

    /**
     * @var boolean
     */
    public $sociOnly;

    public function __construct($args = []){
        if (empty($args)) return $this;

        $this->setId($args[0]->id);
        $this->setNom($args[0]->nom);
        $this->setDescripcio($args[0]->descripcio);
        $this->setTipus($args[0]->tipus);
        $this->setSociOnly($args[0]->sociOnly);
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setActivitat(Activitat $activitat){
        $this->activitat = $activitat;
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

    public function setTipus($tipus){
        $this->tipus = $tipus;
        return $this;
    }

    public function setSociOnly($sociOnly){
        if ($sociOnly == 'on') $this->sociOnly = true;
        else $this->sociOnly = false;
        
        return $this;
    }

}