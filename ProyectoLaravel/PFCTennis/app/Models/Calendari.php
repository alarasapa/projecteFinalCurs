<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Calendari {

        public $activitatId;

        public $horariActivitatId;

        public function setActivitatId($activitatId){
            $this->activitatId = $activitatId;
            return $this;
        }

        public function setHorariActivitatId($horariActivitatId){
            $this->$horariActivitatId = $horariActivitatId;
            return $this;
        }
    }