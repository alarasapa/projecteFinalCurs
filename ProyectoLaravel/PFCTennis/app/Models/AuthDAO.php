<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\DB;
    use App\Providers\RouteServiceProvider;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;
    use App\Models\Localitzacio;

    class AuthDAO {

        /**
         * Funció per a iniciar sessió
         * 
         * @param Request $request El request del formulari
         * 
         * @return Array Resultat de la cerca en la BBDD
         */
        public static function login(Request $request){
            //Nom o correu del usuari
            $email = $request->usuariEmail;
            //La contrasenya enviada, encriptada amb MD5
            $contrasenya = hash('md5', $request->password);

            //Senténcia SQL on es buscarà l'usuari
            $res = DB::select('SELECT * FROM usuari  
                WHERE contrasenya = ? AND email = ?',
                [$contrasenya, $email]);
            
            return $res;
        }

        /**
         * Funció per a insertar un usuari
         * 
         * @param Request $request El request del formulari
         * 
         * @return Usuari Retorna un objecte Usuari
         */
        public static function insertarUsuari(Request $request){
            // Validem les dades
            request()->validate([
                'nom'              => 'required',
                'cognoms'          => 'required',
                'nif'              => 'required | unique:usuari',
                'dataNaixement'    => 'required',
                'email'            => 'required | email | unique:usuari',
                'targetaSanitaria' =>'required | unique:usuari',
                'telefon'          => 'required',
                'adreca'           => 'required',
                'poblacio'         => 'required',
                'codiPostal'       => 'required',
                'provincia'        => 'required',
                'contrasenya'      => 'required | min:8',
            ]);
            
            // Creem un objecte de localització
            $localitzacio = new Localitzacio([$request]);

            // La insertem en la base de dades i agafem l'id
            $localitzacioId = DB::table('localitzacio')->insertGetId([
                'adreca'     => $localitzacio->adreca,
                'poblacio'   => $localitzacio->poblacio,
                'codiPostal' => $localitzacio->codiPostal,
                'provincia'  => $localitzacio->provincia,
            ]);
            
            $localitzacio->setID($localitzacioId);
            // $request->localitzacio = $localitzacio;
            
            // Creem un objecte usuari
            $usuari = new Usuari([$request]);
            
            // Fem la encriptació de la contrasenya
            $contrasenya      = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya      = hash('md5', $contrasenya);
            
            // Y la emmagetzem en l'objecte
            $usuari->setContrasenya($contrasenya);
            $usuari->setLocalitzacio($localitzacio);
            
            // Insertem l'usuari i agafem el seu identificador
            $usuariId = DB::table('usuari')->insertGetId([
                'nom'              => $usuari->nom,
                'cognoms'          => $usuari->cognoms,
                'nif'              => $usuari->nif,
                'targetaSanitaria' => $usuari->targetaSanitaria,
                'email'            => $usuari->email,
                'localitzacio'     => $usuari->localitzacio->id,
                'contrasenya'      => $usuari->contrasenya,
                'rol'              => $usuari->rol,
                'telefon'          => $usuari->telefon,
                'telefon2'         => $usuari->telefon2,
                'dataNaixement'    => $usuari->dataNaixement,
                'dataCreacio'      => $usuari->dataCreacio
            ]);
            
            // Setejem el identificador
            $usuari->setId($usuariId);

            // Retornem l'objecte usuari
            return $usuari;
        } 

        public static function getLocalitzacio($id){
            $res = DB::table('localitzacio')
                    ->join('usuari', 'localitzacio.id', '=', 'usuari.localitzacio')
                    ->select('localitzacio.id', 'localitzacio.adreca', 'localitzacio.poblacio', 'localitzacio.codiPostal', 'localitzacio.provincia')
                    ->where('usuari.id', $id)
                    ->get();
            
            return new Localitzacio($res);
        }

        /**
         * Funció per a comprovar les dades enviades
         * 
         * @param Request $request El request del formulari
         * 
         * @return Boolean Retorna si ja existeix el camp específic
         */
        public static function comprovar(Request $request){
            // Agafem el tipus de dada que es vol comprovar
            $tipusDada = $request->tipusDada;
            // Agafem el valor de la dada
            $valor = $request->valor;
            
            // En funció del tipus de dada, comprovem si ja hi existeix un registre igual
            // $res = DB::table('usuari')->where($tipusDada, $valor);
            switch ($tipusDada) {
                case "email":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari WHERE email = ?', [$valor]);
                    break;
                
                case "nif":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari WHERE nif = ?', [$valor]);
                    break;
                    
                case "targetaSanitaria":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari WHERE targetaSanitaria = ?', [$valor]);
                    break;
            }
            
            // Retornem si es dona el cas o no
            return $res[0]->resultat;
        }

    }