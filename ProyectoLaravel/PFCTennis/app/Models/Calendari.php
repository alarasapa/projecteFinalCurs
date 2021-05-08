<?php
    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Calendari {

        public $activitatId;

        /**
         * @var Array[Date]
         */
        public $dataActivitatId;

        public function setActivitatId($activitatId){
            $this->activitatId = $activitatId;
            return $this;
        }

        public function setDataActivitatId($dataActivitatId){
            $this->$dataActivitatId = $dataActivitatId;
            return $this;
        }
    }