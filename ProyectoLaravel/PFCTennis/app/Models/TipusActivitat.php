<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TipusActivitat {

    public $id;

    public $nom;

    public function __construct($args = []){
        if (empty($args)) return $this;

        $this->setId($args[0]->id);
        $this->setNom($args[0]->nom);
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setNom($nom){
        $this->nom = filter_var($nom, FILTER_SANITIZE_STRING);
        return $this;
    }
}