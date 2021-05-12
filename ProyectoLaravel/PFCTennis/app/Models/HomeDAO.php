<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\TipusSoci;
    use App\Models\ObjecteVista;
    use App\Models\Log;
    use App\Models\Activitat;

    class HomeDAO {

        public static function getActivitats($tipus){
            $res = DB::table('activitat')
                ->join('tipus_activitat', 'tipus_activitat.id', '=', 'activitat.idTipusActivitat')
                ->where('tipus_activitat.nom', $tipus)
                ->get();

            foreach ($res as $activitat){
                $obj = new Activitat(array($activitat));
                $activitats[] = $obj;
            }

            return $activitats;
        }

        /**
         * Funció per a agafar un llistat d'un tipus de taula
         * 
         * @param String $taula Tipus d'objecte que es vol agafar
         * 
         * @return Array $objectes Llistat d'objectes del tipus passat per paràmetre
         */
        public static function getLlistatObjecteVista($taula){
            // Inicialitzem l'array d'objectes
            $objectes = [];

            // Agafem tots els registres d'una taula
            $res = DB::table($taula)->get();
            
            // Per a cada registre...
            foreach ($res as $obj){
                // ...creem una instància amb les dades obtingudes
                $instancia = new ObjecteVista($obj);
                // Afegim la instància a l'array
                $objectes[] = $instancia;
            }

            return $objectes; 
        }

        /**
         * Funció per agafar un objecte específic d'una taula específica
         * 
         * @param String $taula Taula que es vol consultar
         * @param Integer $id Identificador del registre
         * 
         * @return ObjecteVista Objecte retornat de la base de dades
         */
        public static function getObjecteVista($taula, $id){
            // Consultem la base de dades, passant per paràmetre l'dentificador
            $res = DB::table($taula)
                        ->where('id', $id)
                        ->first();

            // Creem l'objecte i el retornem
            return new ObjecteVista($res);
        }

        public static function getTipusSoci(){
            $objectes = [];

            $res = DB::table('tipussoci')->get();

            foreach ($res as $tipus){
                $inst = new TipusSoci($tipus);
                $objectes[] = $inst;
            }

            return $objectes;
        }
    }