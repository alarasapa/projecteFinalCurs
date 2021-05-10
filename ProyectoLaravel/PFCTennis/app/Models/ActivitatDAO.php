<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\DB;
    use App\Providers\RouteServiceProvider;
    use App\Models\Usuari;
    use App\Models\Log;
    use App\Models\Activitat;
    use App\Models\Extra;
    use App\Models\GrupOpcio;
    use App\Models\Localitzacio;

    class ActivitatDAO {
        
         /*********************
         * GESTIO ACTIVITATS *
         *********************/

        public static function getActivitats(){
            // Agafem totes les activitats 
            $res = DB::table('activitat')
                        ->get();
    
            // Iterem el resultat obtingut de la BBDD
            foreach ($res as $activitat){
                //Creem un objecte Extra
                $obj = new Activitat(array($activitat));
                // I el guardem en la array
                $activitats[] = $obj;
            }

            return $activitats;
        
        
        }
        
        public static function getActivitat($id){
            $res = DB::table('activitat')->where('id', $id)->get();

            return new Activitat($res);
        }

        public static function insertarActivitat(Request $request){
            request()->validate([
                'titol'      => 'required',
                'descripcio' => 'required',
                // 'dataInici'  => 'required',
                // 'dataFi'     => 'required',
                // 'horaInici'  => 'required',
                // 'horaFi'     => 'required',
            ]);
            
            // foreach ($request->dataInici as $horari){
            //     //objeto hora actividad
            //     DB::table('hora_activitat')->insert([
            //         'horaInici'
            //     ]);
    
                //objeto data actividad
                // data -> set Hora

            // }
            
            //objeto calendario
            // calendario ->set Data

            $activitat = new Activitat([$request]); 
            DB::table('activitat')->insert([
                'titol'      => $activitat->titol,
                'descripcio' => $activitat->descripcio,
                'formulari'  => $activitat->formulari,
            ]);
            // actividad -> set Calendario

        }

        public static function updateActivitat(Request $request){
            request()->validate([
                'titol'      => 'required',
                'descripcio' => 'required',
                // 'dataInici'  => 'required',
                // 'dataFi'     => 'required',
                // 'horaInici'  => 'required',
                // 'horaFi'     => 'required',
            ]);

            $activitat = new Activitat([$request]); 
            DB::table('activitat')
                ->where('id', $activitat->id)
                ->update([
                'titol'      => $activitat->titol,
                'descripcio' => $activitat->descripcio,
                'formulari'  => $activitat->formulari,
            ]);
        }

        public static function eliminarActivitat($id){
            DB::table('activitat')->delete($id);
        }

        /*****************
         * GESTIO EXTRES *
         *****************/

        /**
         * Funció per extreure tots els extres de la BBDD 
         */
        public static function getExtres(){
            // Agafem tots els extres i els ordenem pel nom 
            $res = DB::table('extres')
                        ->orderByDesc('nom')
                        ->get();
    
            // Iterem el resultat obtingut de la BBDD
            foreach ($res as $extra){
                //Creem un objecte Extra
                $obj = new Extra(array($extra));
                // I el guardem en la array
                $extres[] = $obj;
            }

            return $extres;
        }
    
        public static function getExtra($id){
            $res = DB::table('extres')->where('id', $id)->get();

            return new Extra($res);;
        }

        public static function insertarExtra(Request $request){
            request()->validate([
                'nom'      => 'required | unique:extres',
                'preuSoci' => 'required',
                'preuNoSoci' => 'required',
            ]);

            $extra = new Extra([$request]);

            DB::table('extres')->insert([
                'nom'        => $extra->nom,
                'preuSoci'   => $extra->preuSoci,
                'preuNoSoci' => $extra->preuNoSoci,
            ]);
        }

        public static function updateExtra(Request $request){
            request()->validate([
                'nom'      => 'required | unique:extres',
                'preuSoci' => 'required',
                'preuNoSoci' => 'required',
            ]);

            $extra = new Extra([$request]);

            DB::table('extres')
                ->where('id', $extra->id)
                ->update([
                'nom'        => $extra->nom,
                'preuSoci'   => $extra->preuSoci,
                'preuNoSoci' => $extra->preuNoSoci,
            ]);
        }

        public static function eliminarExtra($id){
            DB::table('extres')->delete($id);
        }

        /***********************
         * GESTIO GRUP OPCIONS *
         ***********************/

        /**
         * Funció per a agafar tots els grups d'opcions
         * 
         * @param string $tipus Tipus de grup d'opcions
         */
        public static function getGrupOpcions($tipus){
            // Agafem tots els grups d'opcions i els ordenem pel nom 
            $res = DB::table('opcions_' . $tipus)
                        ->orderByDesc('nom')
                        ->get();
                        
            // Iterem el resultat obtingut de la BBDD
            foreach ($res as $grup){
                if ($tipus == 'extres') $grup->tipus = null;

                // Creem un objecte GrupOpcio
                $obj = new GrupOpcio(array($grup));

                // Agafem la activitat on es troba aquest grup d'opcions
                $activitat = DB::table('opcions_' . $tipus . '_activitats') 
                            ->join('activitat', 'activitat.id', '=', 'opcions_' . $tipus . '_activitats.idActivitat')
                            ->where('idGrupOpcio', $obj->id)
                            ->get();

                // Creem l'objecte de la activitat i la afegim al grup d'opcions...
                $activitat = new Activitat($activitat);
                $obj->setActivitat($activitat);

                // ..i el guardem en la array
                $grupOpcions[] = $obj;
            }

            return $grupOpcions;
        } 

        public static function getGrupOpcionsActivitat($idActicitat){
            $grupOpcions = [];

            $activitat = ActivitatDAO::getActivitat($idActicitat);

            foreach (ActivitatDAO::getGrupOpcionsActivitatTipus('generals', $idActicitat) as $grup){
                $grup->setActivitat($activitat);
                $grupOpcions[] = $grup;
            }

            foreach (ActivitatDAO::getGrupOpcionsActivitatTipus('extres', $idActicitat) as $grup){
                $grup->setActivitat($activitat);
                $grupOpcions[] = $grup;
            }

            return $grupOpcions;
        }

        public static function getGrupOpcionsActivitatTipus($tipus, $idActicitat){
            $res = [];

            $grupOpcions = DB::table('opcions_'. $tipus . '_activitats')
                            ->join('opcions_'. $tipus, 'opcions_'. $tipus .'.id', '=', 'opcions_'. $tipus .'_activitats.idGrupOpcio')
                            ->where('idActivitat', $idActicitat)
                            ->get();
            
            foreach ($grupOpcions as $grups) {
                if ($tipus == 'extres') $grups->tipus = null;

                $obj = new GrupOpcio(array($grups));
                $res[] = $obj;
            }

            return $res;
        }

        /**
         * Funció per a agafar un grup d'opcions específics
         * 
         * @param string $tipus Tipus de grup d'opcions
         * @param integer $id Identificador del grup d'opcions
         * 
         * @returns {GrupOpcio} Grup d'opcions específic 
         */
        public static function getGrupOpcio($tipus, $id){
            $res = DB::table('opcions_' . $tipus)
                        ->where('id', $id)
                        ->get();
            
            if ($tipus == 'extres') $res[0]->tipus = null;
            
            $grupOpcio = new GrupOpcio($res);
            
            // Agafem la activitat on es troba aquest grup d'opcions
            $activitat = DB::table('opcions_' . $tipus . '_activitats') 
            ->join('activitat', 'activitat.id', '=', 'opcions_' . $tipus . '_activitats.idActivitat')
            ->where('idGrupOpcio', $grupOpcio->id)
            ->get();

            // Creem l'objecte de la activitat i la afegim al grup d'opcions...
            $activitat = new Activitat($activitat);
            $grupOpcio->setActivitat($activitat);

            return $grupOpcio;
        }

        /**
         * Funció per a insertar un grup d'opcions
         * 
         * @param Request $request El request del formulari
         * @param string $tipus Tipus de grup d'opcions
         * @param string $taulaActivitats Nom de la taula a la que es refereix
         */
        public static function insertarGrupOpcions(Request $request, $tipus, $taulaActivitats){
            // Creem l'objecte de grup opció
            $grupOpcio = new GrupOpcio([$request]);

            // Creem l'objecte de l'activitat i l'afegim al grup opció
            $activitat = ActivitatDAO::getActivitat($request->activitatOpcio);
            $grupOpcio->setActivitat($activitat);

            // Depenent del tipus de grup es farán unes validacions o unes altres
            // I s'inserirà en unes taules o unes altres
            if ($tipus == 'general'){
                request()->validate([
                    'nom'        => 'required',
                    'descripcio'   => 'required',
                    'tipus' => 'required',
                ]);
                
                $idGrupOpcio = DB::table('opcions_generals')->insertGetId([
                    'nom'        => $grupOpcio->nom,
                    'descripcio' => $grupOpcio->descripcio,
                    'tipus'      => $grupOpcio->tipus,
                    'sociOnly'   => $grupOpcio->sociOnly,
                ]);
            } 
            else if ($tipus == 'extra'){
                request()->validate([
                    'nom'        => 'required',
                    'descripcio'   => 'required',
                ]);

                $idGrupOpcio = DB::table('opcions_extres')->insertGetId([
                    'nom'        => $grupOpcio->nom,
                    'descripcio' => $grupOpcio->descripcio,
                    'sociOnly'   => $grupOpcio->sociOnly,
                ]);
            }
            
            DB::table($taulaActivitats)->insert([
                'idActivitat'  => $grupOpcio->activitat->id,
                'idGrupOpcio'  => $idGrupOpcio,
            ]);
        }

        /**
         * Funció per a actualitzar un grup d'opcions
         * 
         * @param Request $request El request del formulari
         * @param string $tipus Tipus de grup d'opcions
         */
        public static function updateGrupOpcions(Request $request, $tipus){
            // Creem l'objecte de grup opció
            $grupOpcio = new GrupOpcio([$request]);

            // Creem l'objecte de l'activitat i l'afegim al grup opció
            $activitat = ActivitatDAO::getActivitat($request->activitatOpcio);
            $grupOpcio->setActivitat($activitat);
            
            // Depenent del tipus de grup es farán unes validacions o unes altres
            // I s'inserirà en unes taules o unes altres
            if ($tipus == 'generals'){
                request()->validate([
                    'nom'        => 'required',
                    'descripcio'   => 'required',
                    'tipus' => 'required',
                ]);
                
                DB::table('opcions_generals')
                    ->where('id', $grupOpcio->id)        
                    ->update([
                        'nom'        => $grupOpcio->nom,
                        'descripcio' => $grupOpcio->descripcio,
                        'tipus'      => $grupOpcio->tipus,
                        'sociOnly'   => $grupOpcio->sociOnly,
                    ]);
            } 
            else if ($tipus == 'extres'){
                request()->validate([
                    'nom'        => 'required',
                    'descripcio'   => 'required',
                ]);

                DB::table('opcions_extres')
                    ->where('id', $grupOpcio->id)
                    ->update([
                        'nom'        => $grupOpcio->nom,
                        'descripcio' => $grupOpcio->descripcio,
                        'sociOnly'   => $grupOpcio->sociOnly,
                    ]);
            }
            
            DB::table('opcions_' . $tipus . '_activitats')
                ->where('idGrupOpcio', $grupOpcio->id)
                ->update([
                'idActivitat'  => $grupOpcio->activitat->id,
            ]);
        }

        /**
         * Funció per eliminar un grup d'opcions
         * 
         * @param string $tipus Tipus de grup d'opcions
         * @param integer $id Identificador del grup d'opcions
         */
        public static function eliminarGrupOpcions($tipus, $id){
            DB::table('opcions_' . $tipus)->delete($id);
        }
    }