<?php
    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    // use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Models\Usuari;
    use Illuminate\Notifications\Notifiable;

    class Log {

        /**
         * @var Integer
         */
        public $id;

        /**
         * @var Usuari
         */
        public $usuari;

        /**
         * @var String
         */
        public $descripcio;   

        /**
         * @var DateTime
         */
        public $data;

        public function __construct($log, Usuari $usuari){
            $this->setId($log->id);
            $this->setDescripcio($log->descripcio);
            $this->setUsuari($usuari);
            $this->setData($log->data);
        }

        /*********************
         * GETTERS & SETTERS *
         *********************/

        public function getId(){
            return $this->id;
        }

        public function getUsuari(){
            return $this->usuari;
        }

        public function getDescripcio(){
            return $this->descripcio;
        }

        public function getData(){
            return $this->data;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setUsuari(Usuari $usuari){
            $this->usuari = $usuari;
            return $this;
        }

        public function setDescripcio($descripcio){
            $this->descripcio = filter_var($descripcio, FILTER_SANITIZE_STRING);
            return $this;
        }

        public function setData($data){
            if ($data == NULL){
                $this->data = date('Y-m-d H:i:s');
            } else {
                $this->data = $data;
            }
            return $this;
        }
    }