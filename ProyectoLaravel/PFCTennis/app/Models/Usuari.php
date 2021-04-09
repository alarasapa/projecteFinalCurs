<?php
    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Usuari {
        /**
         * @var String
         */
        private $nom;

        /**
         * @var String
         */
        private $cognoms;   

        /**
         * @var String
         */
        private $nickname;

        /**
         * @var String
         */
        private $contrasenya;

        /**
         * @var String
         */
        private $rol;

        /**
         * @var String
         */
        private $email;

        /**
         * @var String
         */
        private $telefon;

        /**
         * @var Date
         */
        private $dataNaixement;

        /**
         * @var Datetime
         */
        private $dataCreacio;

        public function __constructor(){}

        //AQUÍ IRÁN OTRAS FUNCIONES, SI HACEN FALTA CLARO

        /********************
         * GETTER Y SETTERS *
         ********************/
        
        public function getNom(){
            return $this->nom;
        }

        public function getCognoms(){
            return $this->cognoms;
        }

        public function getNickname(){
            return $this->nickname;
        }

        public function getContrasenya(){
            return $this->contrasenya;
        }

        public function getRol(){
            return $this->rol;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getTelefon(){
            return $this->telefon;
        }

        public function getDataNaixement(){
            return $this->dataNaixement;
        }

        public function getDataCreacio(){
            return $this->dataCreacio;
        }

        public function setNom($nom){
            $this->nom = $nom;
        }

        public function setCognoms($cognoms){
            $this->cognoms = $cognoms;
        }

        public function setNickname($nickname){
            $this->nickname = $nickname;
        }

        public function setContrasenya($contrasenya){
            $this->contrasenya = $contrasenya;
        }

        public function setRol($rol){
            $this->rol = $rol;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setTelefon($telefon){
            $this->telefon = $telefon;
        }

        public function setDataNaixement($dataNaixement){
            $this->dataNaixement = $dataNaixement;
        }

        public function setDataCreacio($dataCreacio){
            $this->dataCreacio = $dataCreacio;
        }
    }
?>