<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Activitat;

class GrupOpcio {

    /**
     * @var Activitat
     */
    public $activitat;

    /**
     * @var string
     */
    public $titol;

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

        $this->setTitol($args[0]->titol);
        $this->setDescripcio($args[0]->descripcio);
        $this->setTipus($args[0]->tipus);
        $this->setSociOnly($args[0]->sociOnly);
    }

    public function setActivitat(Activitat $activitat){
        $this->activitat = $activitat;
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

    public function setTipus($tipus){
        $this->tipus = $tipus;
        return $this;
    }

    public function setSociOnly($sociOnly){
        $this->sociOnly = $sociOnly;
        return $this;
    }

}