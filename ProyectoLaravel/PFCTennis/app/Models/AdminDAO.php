<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\HomeDAO;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;
    use App\Models\Localitzacio;

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
            $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nif, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.targetaSanitaria, u.telefon, u.telefon2, u.dataNaixement, u.dataCreacio 
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
            $usuari = new Usuari([$res]);            

            $localitzacio = AuthDAO::getLocalitzacio($id);
            $usuari->setLocalitzacio($localitzacio);

            return $usuari;
        }

        /**
         * Funció per a insertar un usuari a la base de dades
         * 
         * @param Request $request Informació del formulari del usuari
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
            
            // Agafem la localització
            $localitzacio = new Localitzacio([$request]);

            // La insertem en la base de dades i agafem l'id
            $localitzacioId = DB::table('localitzacio')->insertGetId([
                'adreca'     => $localitzacio->adreca,
                'poblacio'   => $localitzacio->poblacio,
                'codiPostal' => $localitzacio->codiPostal,
                'provincia'  => $localitzacio->provincia,
            ]);
            
            $localitzacio->setID($localitzacioId);

            // Creem un objecte usuari
            $usuari = new Usuari([$request]);

            // Fem la encriptació de la contrasenya
            $contrasenya      = filter_var($request->contrasenya, FILTER_SANITIZE_STRING);
            $contrasenya      = hash('md5', $contrasenya);
            
            // Y la emmagetzem en l'objecte
            $usuari->setContrasenya($contrasenya);
            $usuari->setLocalitzacio($localitzacio);

            //Insertem l'usuari
            DB::table('usuari')->insert([
                'nom'              => $usuari->nom,
                'cognoms'          => $usuari->cognoms,
                'nif'              => $usuari->nif,
                'targetaSanitaria' => $usuari->targetaSanitaria,
                'email'            => $usuari->email,
                'contrasenya'      => $usuari->contrasenya,
                'telefon'          => $usuari->telefon,
                'telefon2'         => $usuari->telefon2,
                'dataNaixement'    => $usuari->dataNaixement,
                'dataCreacio'      => $usuari->dataCreacio,
                'localitzacio'     => $usuari->localitzacio->id,
            ]);

            // Afegim als logs que hem fet els canvis
            $descripcio = "Ha afegit l'usuari: " . $usuari->nom . " " . $usuari->cognoms;
            $dataActualitzacio = date('Y-m-d H:i:s');
 
            DB::table('log_admin')->insert([
                'id'         => Auth::user()->id,
                'descripcio' => $descripcio,
                'data'       => $dataActualitzacio,
            ]);
        }

        /**
         * Funció per a insertar una vista en la base de dades
         * 
         * @param Reques $request Informació del formulari
         */
        public static function insertarVista(Request $request){
            // Validem les dades
            $request->validate([
                'titol' => 'required',
                'descripcio' => 'required',
                'imatge' => 'required',
            ]);

            // Agafem el nom real de la imatge
            $request->imatge = $request->imatge->getClientOriginalName();

            // Creem un objecte vista
            $vista = new ObjecteVista($request);
            
            $taula = AdminDAO::switchVista($request->tipus);

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
                'nom'              => 'required',
                'cognoms'          => 'required',
                'nif'              => 'required | unique:usuari,nif,' . $request->id,
                'dataNaixement'    => 'required',
                'email'            => 'required | email | unique:usuari,email,' . $request->id,
                'targetaSanitaria' => 'required | unique:usuari,targetaSanitaria,' . $request->id,
                'telefon'          => 'required',
                'adreca'           => 'required',
                'poblacio'         => 'required',
                'codiPostal'       => 'required',
                'provincia'        => 'required',
            ]);

            // Creem la localització
            $localitzacio = new Localitzacio([$request]);
            $localitzacio->setId($request->idLocalitzacio);

            // Actualitzem la localització
            DB::table('localitzacio')
                ->where('id', $localitzacio->id)
                ->update([
                    'adreca'     => $localitzacio->adreca,
                    'poblacio'   => $localitzacio->poblacio,
                    'codiPostal' => $localitzacio->codiPostal,
                    'provincia'  => $localitzacio->provincia,
                ]);

            // Creem l'objecte de l'usuari
            $usuari = new Usuari([$request]);

            // Actualitzem l'usuari
            DB::table('usuari')
                ->where('id', $usuari->id)
                ->update([    
                    'nom'              => $usuari->nom,
                    'cognoms'          => $usuari->cognoms,
                    'nif'              => $usuari->nif,
                    'targetaSanitaria' => $usuari->targetaSanitaria,
                    'email'            => $usuari->email,
                    'telefon'          => $usuari->telefon,
                    'telefon2'         => $usuari->telefon2,
                    'dataNaixement'    => $usuari->dataNaixement,
                    'rol'              => $usuari->rol,
                ]);

            // Afegim als logs que hem fet els canvis
            $descripcio = "Ha cambiat les dades de " . $usuari->nom . " " . $usuari->cognoms;
            $dataActualitzacio = date('Y-m-d H:i:s');

            DB::table('log_admin')->insert([
                'idAdmin'    => Auth::user()->id,
                'descripcio' => $descripcio,
                'data'       => $dataActualitzacio,
            ]);

            // Redireccionem a la taula d'usuaris
            return redirect("usuaris.gestioUsuaris");
        }

        /**
         * Funció per a actualitzar la vista
         */
        public static function updateVista(Request $request){
            // Validem les dades
            $request->validate([
                'titol' => 'required',
                'descripcio' => 'required',
            ]);
            
            // Segons el tipus és una taula o una altre
            $taula = AdminDAO::switchVista($request->tipus);
            
            if ($request->imatge == NULL){
                $aux = DB::table($taula)->select('imatge')->where('id', $request->id)->get();
                $request->imatge = $aux[0]->imatge;
            } else {
                // Agafem el nom real de la imatge
                $request->imatge = $request->imatge->getClientOriginalName();
            }
            
            // Creem un objecte vista
            $vista = new ObjecteVista($request);

            DB::table($taula)->where('id', $request->id)->update([
                'imatge' => $request->imatge,
                'titol' => $request->titol,
                'descripcio' => $request->descripcio,
            ]);
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

        /**
         * Funció per a eliminar una vista
         * 
         * @param Integer $id Identificador de la vista
         * @param String $tipus Tipus de vista
         */
        public static function eliminarVista($id, $tipus){
            // Agafem la taula a la que es refereix
            $taula = AdminDAO::switchVista($tipus);

            // Eliminem la taula
            DB::table($taula)->delete($id);
        }

        public static function getObjecteVista($accio, $id){
            
            switch ($accio){
                case "slider":
                    return HomeDAO::getObjecteVista('inici_vista', $id);
                
                case "cartes":
                    return HomeDAO::getObjecteVista('cartes_inici_vista', $id);
            }
        }

        public static function switchVista($tipo){
            switch ($tipo) {
                case "slider":
                    return 'inici_vista';

                case "cartes":
                    return 'cartes_inici_vista';
            }
        }

    }