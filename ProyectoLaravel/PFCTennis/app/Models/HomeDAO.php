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
    use App\Models\ActivitatDAO;

    class HomeDAO {

        /**
         * Funció per agafar totes les activitats segons el tipus
         * 
         * @param string $tipus Tipus d'activitat que es vol agafar
         * 
         * @return Array{Activitat} d'objecte Activitat
         */
        public static function getActivitats($tipus){
            // Agafem activitats on el nom del tipus sigui el mateix al que li hem passat
            $res = DB::table('activitat')
                ->join('tipus_activitat', 'tipus_activitat.id', '=', 'activitat.idTipusActivitat')
                ->where('tipus_activitat.nom', '=', $tipus)
                ->select('activitat.*')
                ->get();

            foreach ($res as $activitat){
                $act = new Activitat(array($activitat));

                $extres = ActivitatDAO::getExtresActivitat($act->id);
                $grupsOpcions = ActivitatDAO::getGrupOpcionsActivitat($act->id);

                foreach ($grupsOpcions as $grup){
                    if ($grup->tipus == null) $tipus = 'extres';
                    else $tipus = 'generals';

                    $opcions = ActivitatDAO::getOpcions($grup->id, $tipus);
                    $grup->setOpcions($opcions);
                }

                $act->setExtres($extres);
                $act->setGrupOpcio($grupsOpcions);

                $activitats[] = $act;
            }

            return $activitats;
        }

        /**
         * Funció per a agafar un llistat d'un tipus de taula
         * 
         * @param string $taula Tipus d'objecte que es vol agafar
         * 
         * @return Array{ObjecteVista} $objectes Llistat d'objectes del tipus passat per paràmetre
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
         * @param string $taula Taula que es vol consultar
         * @param integer $id Identificador del registre
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