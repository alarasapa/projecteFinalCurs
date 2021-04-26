<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\HomeDAO;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class AdminDAO {

        /**
         * Funció per agafar els registres dels administradors
         * 
         * @return Array Llistat dels registres dels administradors
         */
        public static function getLogsAdmins(){
            // Inicialitzem el llistat de registres
            $logsAdmins = [];

            // Realitzem la consulta en la base de dades
            $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nif, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.targetaSanitaria, u.telefon, u.dataNaixement, u.dataCreacio 
                FROM log_admin lg INNER JOIN usuari u ON lg.idAdmin = u.id ORDER BY lg.data');
    
            // Iterem el resultat obtingut
            foreach ($res as $log){
                // Creem un objecte d'un usuari
                $usuariObj = new Usuari(array($log));
                // Creem un objecte d'un registre
                $logObj = new Log($log, $usuariObj);
                // Afegim al llistat de registres
                $logsAdmins[] = $logObj;
            }

            return $logsAdmins;
        }

        /**
         * Funció per a agafar tots els usuaris de la base de dades
         * 
         * @return Array Llistat d'objectes d'usuaris
         */
        public static function getUsuaris(){
            $usuaris = [];

            // Agafem tots els usuaris i els ordenem pel cognom 
            $res = DB::table('usuari')
                        ->orderByDesc('cognoms')
                        ->get();
    
            // Iterem el resultat obtingut de la BBDD
            foreach ($res as $usuari){
                //Creem un objecte Usuari
                $obj = new Usuari(array($usuari));
                // I el guardem en la array
                $usuaris[] = $obj;
            }

            return $usuaris;
        }

        /**
         * Funció per a agafar un usuari específic
         * 
         * @param Integer Identificador del usuari
         * 
         * @return Usauri Objecte usuari agafat de la base de dades
         */
        public static function getUsuari($id){
            // Consultem la base de dades, passant per paràmetre l'dentificador
            $res = DB::table('usuari')
                        ->where('id', $id)
                        ->first();

            // Creem l'objecte i el retornem
            return new Usuari([$res]);
        }

        /**
         * Funció per a insertar un usuari a la base de dades
         * 
         * @param Request $request Informació del formulari del usuari
         */
        public static function insertarUsuari(Request $request){
            // Validem les dades
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
        
             // Afegim als logs que hem fet els canvis
             $descripcio = "Ha afegit l'usuari: " . $usuari->nom . " " . $usuari->cognoms;
             $dataActualitzacio = date('Y-m-d H:i:s');
 
             DB::insert('INSERT INTO log_admin(idAdmin, descripcio, data) VALUES(?, ?, ?)',
                [Auth::user()->id, $descripcio, $dataActualitzacio]); 
        }

        public static function insertarVista(Request $request){
            // Validem les dades
            $request->validate([
                'titol' => 'required',
                'descripcio' => 'required',
                'imatge' => 'required',
            ]);

            $request->imatge = $request->imatge->getClientOriginalName();

            // Creem un objecte vista
            $vista = new ObjecteVista($request);
            
            // Segons el tipus és una taula o una altre
            switch ($request->tipus){
                case 'slider':
                    $taula = 'inici_vista';
                    break;
                
                case 'cartes':
                    $taula = 'cartes_inici_vista';
                    break;
            }

            // Per últim afegim a la base de dades
            DB::table($taula)->insert([
                'titol' => $vista->titol,
                'descripcio' => $vista->descripcio,
                'imatge' => $vista->imatge,
            ]);
        }

        /**
         * Funció per a actualitzar un usuari
         * 
         * @param Request $request Informació del formulari del usuari
         * 
         * @return Route Redireccionament 
         */
        public static function updateUsuari(Request $request){
            // Validació de les dades
            request()->validate([
                'nom' => 'required',
                'cognoms' => 'required',
                'nif' => 'required | unique:usuari,nif,' . $request->id,
                'dataNaixement' => 'required',
                'email' => 'required | email | unique:usuari,email,' . $request->id,
                'targetaSanitaria' =>'required | unique:usuari,targetaSanitaria,' . $request->id,
                'telefon' => 'required',
            ]);

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

        /**
         * Funció per eliminar un usuari
         * 
         * @param Integer $id Identificador d'un usuari
         */
        public static function eliminarUsuari($id){
            // Eliminem l'usuari passant-li l'identificador del usuari
            DB::delete('DELETE FROM usuari WHERE id = ?', [$id]);
            
            // Afegim als logs que hem fet els canvis
            $descripcio = "Ha eliminat un usuari";
            $dataActualitzacio = date('Y-m-d H:i:s');

            DB::insert('INSERT INTO log_admin(idAdmin, descripcio, data) VALUES(?, ?, ?)',
                                        [Auth::user()->id, $descripcio, $dataActualitzacio]);


        }

        public static function getObjecteVista($accio, $id){
            
            switch ($accio){
                case "slider":
                    return HomeDAO::getObjecteVista('inici_vista', $id);
                
                case "cartes":
                    return HomeDAO::getObjecteVista('cartes_inici_vista', $id);
            }
        }
    }