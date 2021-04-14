<?php
    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    // use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class Usuari extends Authenticatable {

        protected $fillable = [
            'nom',
            'cognoms',
            'nickname',
            'rol',
            'telefon',
            'dataNaixement',
            'dataCreacio',
            'email',
            'contrasenya',
        ];

        protected $hidden = [
            'contrasenya',
        ];

        /**
         * @var Integer
         */
        public $id;

        /**
         * @var String
         */
        public $nom;

        /**
         * @var String
         */
        public $cognoms;   

        /**
         * @var String
         */
        public $nickname;

        /**
         * @var String
         */
        public $contrasenya;

        /**
         * @var String
         */
        public $rol;

        /**
         * @var String
         */
        public $email;

        /**
         * @var String
         */
        public $telefon;

        /**
         * @var Date
         */
        public $dataNaixement;

        /**
         * @var Datetime
         */
        public $dataCreacio;

        public function __construct(array $args = []){
            $this->setId($args[0]->id);
            $this->setNom($args[0]->nom);
            $this->setCognoms($args[0]->cognoms);
            $this->setNickname($args[0]->nickname);
            $this->setContrasenya($args[0]->contrasenya);
            $this->setRol($args[0]->rol);
            $this->setEmail($args[0]->email);
            $this->setTelefon($args[0]->telefon);
            $this->setDataNaixement($args[0]->dataNaixement);
            $this->setDataCreacio($args[0]->dataCreacio);
        }

        //AQUÍ IRÁN OTRAS FUNCIONES, SI HACEN FALTA CLARO

        /********************
         * GETTER Y SETTERS *
         ********************/
        
        public function getId(){
            return $this->id;
        }

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

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setNom($nom){
            $this->nom = $nom;
            return $this;
        }

        public function setCognoms($cognoms){
            $this->cognoms = $cognoms;
            return $this;
        }

        public function setNickname($nickname){
            $this->nickname = $nickname;
            return $this;
        }

        public function setContrasenya($contrasenya){
            $this->contrasenya = $contrasenya;
            return $this;
        }

        public function setRol($rol){
            $this->rol = $rol;
            return $this;
        }

        public function setEmail($email){
            $this->email = $email;
            return $this;
        }

        public function setTelefon($telefon){
            $this->telefon = $telefon;
            return $this;
        }

        public function setDataNaixement($dataNaixement){
            $this->dataNaixement = $dataNaixement;
            return $this;
        }

        public function setDataCreacio($dataCreacio){
            $this->dataCreacio = $dataCreacio;
            return $this;
        }
    }
?>