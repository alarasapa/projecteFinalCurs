<?php
    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Localitzacio extends Authenticatable {

        /**
         * @var Integer
         */
        public $id;

        /**
         * @var String
         */
        public $adreca;
        
        /**
         * @var String
         */
        public $poblacio;
        
        /**
         * @var Integer
         */
        public $codiPostal;

        /**
         * @var String
         */
        public $provincia;

        public function __construct($args = []){
            if (empty($args)) return $this;
            $this->setId($args[0]->id);
            $this->setAdreca($args[0]->adreca);
            $this->setPoblacio($args[0]->poblacio);
            $this->setCodiPostal($args[0]->codiPostal);
            $this->setProvincia($args[0]->provincia);
        }

        /*********************
         * GETTERS & SETTERS *
         ********************/

        public function getId(){
            return $this->id;
        }

        public function getAdreca(){
            return $this->adreca;
        }

        public function getPoblacio(){
            return $this->poblacio;
        }

        public function getCodiPostal(){
            return $this->codiPostal;
        }

        public function getProvincia(){
            return $this->provincia;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setAdreca($adreca){
            $this->adreca = filter_var($adreca, FILTER_SANITIZE_STRING);
            return $this;
        }

        public function setPoblacio($poblacio){
            $this->poblacio = filter_var($poblacio, FILTER_SANITIZE_STRING);
            return $this;
        }

        public function setCodiPostal($codiPostal){
            $this->codiPostal = $codiPostal;
            return $this;
        }

        public function setProvincia($provincia){
            $this->provincia = filter_var($provincia, FILTER_SANITIZE_STRING);
            return $this;
        }
    }