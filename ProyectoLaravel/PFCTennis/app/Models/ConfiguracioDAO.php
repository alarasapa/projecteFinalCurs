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
         */
        public static function cambiarDades(Request $request){
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
         */
        public static function cambiarPassword(Request $request){
            $id = $request->id;
            $contrasenya = $request->contrasenya;
            $contrasenya = filter_var($contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya = hash('md5', $contrasenya);

            DB::update('UPDATE usuari SET contrasenya = ?
                        WHERE id = ?', [$contrasenya, $id]);

            $descripcio = "Ha cambiat la seva contrasenya";
            $dataActualitzacio = date('Y-m-d H:i:s');
            DB::insert('INSERT INTO log_usuari(idUsuari, descripcio, data) VALUES(?, ?, ?)',
                    [$id, $descripcio, $dataActualitzacio]);
        }

        /**
         * Funció per a comprovar les dades d'un usuari
         */
        public static function comprovarDades(Request $request){
            $tipusDada = $request->tipusDada;
            $valor = $request->valor;
            $dadaActual = $request->dadaActual;

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

            return $res[0]->resultat;
        }

    }