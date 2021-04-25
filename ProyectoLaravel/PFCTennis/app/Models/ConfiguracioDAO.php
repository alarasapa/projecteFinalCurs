<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class ConfiguracioDAO {

        /**
         * Funció per a cambiar les dades d'un usuari
         * 
         * @param Request $request Informació del formulari
         */
        public static function cambiarDades(Request $request){
            // Validem les dades
            request()->validate([
                'nom' => 'required',
                'cognoms' => 'required',
                'nif' => 'required | unique:usuari,nif,'.Auth::user()->id,
                'dataNaixement' => 'required',
                'email' => 'required | email | unique:usuari,email,'.Auth::user()->id,
                'targetaSanitaria' =>'required | unique:usuari,targetaSanitaria,'.Auth::user()->id,
                'telefon' => 'required',
            ]);

            // Creem l'objecte de l'usuari
            $usuari = new Usuari([$request]);
        
            // Actualitzem les seves dades
            DB::update('UPDATE usuari 
                    SET nif = ?, nom = ?, cognoms = ?,
                    email = ?, targetaSanitaria = ?, telefon = ?, dataNaixement = ?
                    WHERE id = ?', 
            [$usuari->nif, $usuari->nom, $usuari->cognoms, $usuari->email, 
            $usuari->targetaSanitaria, $usuari->telefon, $usuari->dataNaixement, $usuari->id]);
    
            // Afegim als logs el canvi
            $descripcio = "Ha cambiat les seves dades";
            $dataActualitzacio = date('Y-m-d H:i:s');
            DB::insert('INSERT INTO log_usuari(idUsuari, descripcio, data) VALUES(?, ?, ?)',
                            [$usuari->id, $descripcio, $dataActualitzacio]);    
        }

        /**
         * Funció per a cambiar la contrasenya del usuari
         * 
         * @param Request $request Informació del formulari
         */
        public static function cambiarPassword(Request $request){
            // Validem les dades
            request()->validate([
                'contrasenya' => 'required | min:8'
            ]);

            // Agafem les dades
            $id = $request->id;
            $contrasenya = $request->contrasenya;
            $contrasenya = filter_var($contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya = hash('md5', $contrasenya);

            // Actualitzem les dades del usuari en la base de dades
            DB::update('UPDATE usuari SET contrasenya = ?
                        WHERE id = ?', [$contrasenya, $id]);
        }

        /**
         * Funció per a comprovar les dades d'un usuari
         * 
         * @param Request $request Informació del formulari
         * 
         * @return Boolean Retorna si ja existeix el camp específic
         */
        public static function comprovarDades(Request $request){
            // Agafem el tipus de dada que es vol comprovar
            $tipusDada = $request->tipusDada;
            // Agafem el valor de la dada
            $valor = $request->valor;
            // Agafem el valor de la dada actual
            $dadaActual = $request->dadaActual;

            // En funció del tipus de dada, comprovem si ja hi existeix un registre igual
            switch($tipusDada){
                case "nif":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari 
                        WHERE nif = ? AND nif != ?', [$valor, $dadaActual]);
                    break;
                
                case "email":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari 
                        WHERE email = ? AND email != ?', [$valor, $dadaActual]);
                    break;
                
                case "targetaSanitaria":
                    $res = DB::select('SELECT COUNT(*) AS resultat FROM usuari 
                        WHERE targetaSanitaria = ? AND targetaSanitaria != ?', [$valor, $dadaActual]);
                    break;
            }
            
            // Retornem si es dona el cas o no
            return $res[0]->resultat;
        }

    }