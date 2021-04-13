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
        private $id;

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
            return $this->id;
        }

        public function setNom($nom){
            $this->nom = $nom;
            return $this->nom;
        }

        public function setCognoms($cognoms){
            $this->cognoms = $cognoms;
            return $this->cognoms;
        }

        public function setNickname($nickname){
            $this->nickname = $nickname;
            return $this->nickname;
        }

        public function setContrasenya($contrasenya){
            $this->contrasenya = $contrasenya;
            return $this->contrasenya;
        }

        public function setRol($rol){
            $this->rol = $rol;
            return $this->rol;
        }

        public function setEmail($email){
            $this->email = $email;
            return $this->email;
        }

        public function setTelefon($telefon){
            $this->telefon = $telefon;
            return $this->telefon;
        }

        public function setDataNaixement($dataNaixement){
            $this->dataNaixement = $dataNaixement;
            return $this->dataNaixement;
        }

        public function setDataCreacio($dataCreacio){
            $this->dataCreacio = $dataCreacio;
            return $this->dataCreacio;
        }
    }
?>