<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class HomeDAO {

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
    }