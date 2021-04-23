<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class AdminDAO {

        public static function getLogsUsuari(){
            $logsUsuaris = [];

            $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nif, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.targetaSanitaria, u.telefon, u.dataNaixement, u.dataCreacio 
                FROM log_usuari lg INNER JOIN usuari u ON lg.idUsuari = u.id ORDER BY lg.data');
    
            foreach ($res as $log){
                $usuariObj = new Usuari(array($log));
                $logObj = new Log($log, $usuariObj);
                $logsUsuaris[] = $logObj;
            }

            return $logsUsuaris;
        }

        public static function getUsuaris(){
            $usuaris = [];
            // Agafem tots els usuaris i els ordenem pel cognom 
            $res = DB::select('SELECT * FROM usuari ORDER BY cognoms');
    
            // Iterem el resultat obtingut de la BBDD
            foreach ($res as $usuari){
                //Creem un objecte Usuari
                $obj = new Usuari(array($usuari));
                // I el guardem en la array
                $usuaris[] = $obj;
            }

            return $usuaris;
        }

        public static function getUsuari($id){

            $res = DB::select('SELECT * FROM usuari WHERE id = ?', [$id]);
            
            return new Usuari($res);
        }

        public static function insertarUsuari(Request $request){
            // Obtenim les dades
            $nom           = filter_var($request->nom, FILTER_SANITIZE_STRING);
            $cognoms       = filter_var($request->cognoms, FILTER_SANITIZE_STRING);
            $email         = $request->email;
            $contrasenya   = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya   = hash('md5', $contrasenya);
            $rol           = $request->rol;
            $telefon       = $request->telefon;
            $dataNaixement = $request->dataNaixement;
            $dataCreacio   = date('Y-m-d H:i:s');

            //Insertem l'usuari
            DB::insert('INSERT INTO usuari (nom, cognoms, email, contrasenya, rol, telefon, dataNaixement, dataCreacio) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)', [$nom, $cognoms, $email, $contrasenya, $rol, $telefon, $dataNaixement, $dataCreacio]);
        }

        public static function updateUsuari(Request $request){
            $usuari = new Usuari([$request]);
            //TODO FALTA TERMINAR EL UPDATE 
        }
    }