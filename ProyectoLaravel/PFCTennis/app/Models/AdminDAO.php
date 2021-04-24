<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class AdminDAO {

        public static function getLogsUsuari(){
            $logsAdmins = [];

            $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nif, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.targetaSanitaria, u.telefon, u.dataNaixement, u.dataCreacio 
                FROM log_admin lg INNER JOIN usuari u ON lg.idAdmin = u.id ORDER BY lg.data');
    
            foreach ($res as $log){
                $usuariObj = new Usuari(array($log));
                $logObj = new Log($log, $usuariObj);
                $logsAdmins[] = $logObj;
            }

            return $logsAdmins;
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
                
            // Obtenim les dades
            $nom              = filter_var($request->nom, FILTER_SANITIZE_STRING);
            $cognoms          = filter_var($request->cognoms, FILTER_SANITIZE_STRING);
            $nif              = filter_var($request->nif, FILTER_SANITIZE_STRING);
            $targetaSanitaria = filter_var($request->targetaSanitaria, FILTER_SANITIZE_STRING);
            $email            = $request->email;
            $contrasenya      = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya      = hash('md5', $contrasenya);
            $rol              = $request->rol;
            $telefon          = $request->telefon;
            $dataNaixement    = $request->dataNaixement;
            $dataCreacio      = date('Y-m-d H:i:s');

            //Insertem l'usuari
            DB::insert('INSERT INTO usuari (nom, cognoms, nif, targetaSanitaria, email, contrasenya, rol, telefon, dataNaixement, dataCreacio) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [$nom, $cognoms, $nif, $targetaSanitaria, $email, $contrasenya, $rol, $telefon, $dataNaixement, $dataCreacio]);
        }

        public static function updateUsuari(Request $request){
            // Creem l'objecte de l'usuari
            $usuari = new Usuari([$request]);

            // Fem l'actualització del usuari
            DB::update('UPDATE usuari 
                SET nif = ?, nom = ?, cognoms = ?,
                email = ?, targetaSanitaria = ?, telefon = ?, dataNaixement = ?, rol = ?
                WHERE id = ?', 
                [$usuari->nif, $usuari->nom, $usuari->cognoms, $usuari->email, $usuari->targetaSanitaria, $usuari->telefon, $usuari->dataNaixement, $usuari->rol, $usuari->id]);

            // Afegim als logs que hem fet els canvis
            $descripcio = "Ha cambiat les dades de " . $usuari->nom . " " . $usuari->cognoms;
            $dataActualitzacio = date('Y-m-d H:i:s');

            DB::insert('INSERT INTO log_admin(idAdmin, descripcio, data) VALUES(?, ?, ?)',
                                        [Auth::user()->id, $descripcio, $dataActualitzacio]);

            // Redireccionem a la taula d'usuaris
            return redirect("gestioUsuaris");
        }

        public static function eliminarUsuari($id){
            DB::delete('DELETE FROM usuari WHERE id = ?', [$id]);

            // Afegim als logs que hem fet els canvis
            // $descripcio = "Ha eliminat un usuari";
            // $dataActualitzacio = date('Y-m-d H:i:s');

            // DB::insert('INSERT INTO log_admin(idAdmin, descripcio, data) VALUES(?, ?, ?)',
            //                             [Auth::user()->id, $descripcio, $dataActualitzacio]);


        }
    }