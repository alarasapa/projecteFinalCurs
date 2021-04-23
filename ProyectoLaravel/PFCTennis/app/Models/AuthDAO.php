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
                'email' => 'required | email',
                'telefon' => 'required',
                'dataNaixement' => 'required',
                'nif' => 'required | regex: /^[0-9]{8}[a-zA-Z]/',
                'telefon' => 'required',
                'contrasenya' => 'required | min:8'
            ]);
    
            // Obtenim les dades
            $nom              = filter_var($request->nom, FILTER_SANITIZE_STRING);
            $cognoms          = filter_var($request->cognoms, FILTER_SANITIZE_STRING);
            $email            = $request->email;
            $nif              = filter_var($request->nif, FILTER_SANITIZE_STRING);
            $targetaSanitaria = filter_var($request->targetaSanitaria, FILTER_SANITIZE_STRING);
            $contrasenya      = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya      = hash('md5', $contrasenya);
            $rol              = $request->rol;
            $telefon          = $request->telefon;
            $dataNaixement    = $request->dataNaixement;
            $dataCreacio      = date('Y-m-d H:i:s');
    
            //Insertem l'usuari
            DB::insert('INSERT INTO usuari (nif, nom, cognoms, email, targetaSanitaria, contrasenya, rol, telefon, dataNaixement, dataCreacio) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$nif, $nom, $cognoms, $email, $targetaSanitaria, $contrasenya, $rol, $telefon, $dataNaixement, $dataCreacio]);
            
            // Agafem el identificador
            $res = DB::select("SELECT id FROM usuari WHERE nif = ?", [$nif]);

            // Agafem y igualem al identificador
            $request->id = $res[0]->id;

            // Creem l'objecte usuari
            return new Usuari([$request]);
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

        // public static function obtenirId($nif){
        //     $res = DB::select("SELECT id FROM usuari WHERE nif = ?", [$nif]);
        
        //     return $res[0]->id;
        // }
    }