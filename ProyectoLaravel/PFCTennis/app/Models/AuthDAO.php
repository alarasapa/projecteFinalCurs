<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\DB;
    use App\Providers\RouteServiceProvider;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

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
            request()->validate([
                'nom' => 'required',
                'cognoms' => 'required',
                'nif' => 'required | unique:usuari',
                'dataNaixement' => 'required',
                'email' => 'required | email | unique:usuari',
                'targetaSanitaria' =>'required | unique:usuari',
                'telefon' => 'required',
                'contrasenya' => 'required | min:8'
            ]);
    
            // Creem un objecte usuari
            $usuari = new Usuari([$request]);

            // Fem la encriptació de la contrasenya
            $contrasenya      = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya      = hash('md5', $contrasenya);
            // Y la emmagetzem en l'objecte
            $usuari->setContrasenya($contrasenya);
    
            //Insertem l'usuari
            DB::insert('INSERT INTO usuari (nom, cognoms, nif, targetaSanitaria, email, contrasenya, rol, telefon, dataNaixement, dataCreacio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                [$usuari->nom, $usuari->cognoms, $usuari->nif, $usuari->targetaSanitaria, $usuari->email, $usuari->contrasenya, 
                $usuari->rol, $usuari->telefon, $usuari->dataNaixement, $usuari->dataCreacio]);

            // Agafem el identificador
            $res = DB::select("SELECT id FROM usuari WHERE nif = ?", [$usuari->nif]);

            // Agafem y setejem el identificador
            $usuari->setId($res[0]->id);

            // Retornem l'objecte usuari
            return $usuari;
        } 

        /**
         * Funció per a comprovar les dades enviades
         * 
         * @param Request $request El request del formulari
         * 
         * @return Boolean Retorna si ja existeix el camp específic
         */
        public static function comprovar(Request $request){
            $tipusDada = $request->tipusDada;
            $valor = $request->valor;
            
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
            
            return $res[0]->resultat;
        }

    }