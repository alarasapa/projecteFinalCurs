<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\DB;
    use App\Providers\RouteServiceProvider;
    use App\Models\Usuari;
    use App\Models\Localitzacio;
    use App\Models\Log;
    use App\Models\Activitat;
    use App\Models\TipusActivitat;
    use App\Models\Extra;
    use App\Models\GrupOpcio;
    use App\Models\Opcio;

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
            $res = DB::table('activitat')
                ->where('activitat.id', $id)
                ->get();
            
            return new Activitat($res);

        }

        public static function insertarActivitat(Request $request){
            request()->validate([
                'titol'            => 'required',
                'descripcio'       => 'required',
                'idTipusActivitat' => 'required',
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
            $activitatId = DB::table('activitat')->insertGetId([
                'titol'            => $activitat->titol,
                'descripcio'       => $activitat->descripcio,
                'formulari'        => $activitat->formulari,
                'idTipusActivitat' => $activitat->idTipusActivitat,
            ]);
            // actividad -> set Calendario

            return $activitatId;
        }

        public static function updateActivitat(Request $request){
            request()->validate([
                'titol'            => 'required',
                'descripcio'       => 'required',
                'idTipusActivitat' => 'required',
                // 'dataInici'  => 'required',
                // 'dataFi'     => 'required',
                // 'horaInici'  => 'required',
                // 'horaFi'     => 'required',
            ]);

            $activitat = new Activitat([$request]); 
            DB::table('activitat')
                ->where('id', $activitat->id)
                ->update([
                'titol'            => $activitat->titol,
                'descripcio'       => $activitat->descripcio,
                'formulari'        => $activitat->formulari,
                'idTipusActivitat' => $activitat->idTipusActivitat,
            ]);
        }

        public static function eliminarActivitat($id){
            DB::table('activitat')->delete($id);
        }

        public static function insertarExtresActivitat(Request $request, $idActivitat){
            $extres = $request->extraOpcions;
            
            if ($extres == null) return;
            
            foreach ($extres as $extra){
                DB::table('extres_activitats')->insert([
                    'idActivitat' => $idActivitat,
                    'idExtra'     => $extra,
                ]);
            }
        }

        public static function updateExtresActivitat(Request $request){
            DB::table('extres_activitats')->where('idActivitat', $request->id)->delete();
            
            ActivitatDAO::insertarExtresActivitat($request, $request->id);
        }

        /**************************
         * GESTIO TIPUS ACTIVITAT *
         **************************/
        
        public static function getTipusActivitats(){
            $res = DB::table('tipus_activitat')->get();
            
            foreach ($res as $tipus){
                $obj = new TipusActivitat(array($tipus));
                $tipusActivitat[] = $obj;
            }

            return $tipusActivitat;
        }
        
        public static function getTipusActivitat($id){
            $res = DB::table('tipus_activitat')->where('id', $id)->get();
            
            return new TipusActivitat($res);    
        }

        public static function insertarTipusActivitat(Request $request){
            request()->validate([
                'nom' => 'required',
            ]);

            $tipusActivitat = new TipusActivitat([$request]); 

            DB::table('tipus_activitat')->insert([
                'nom' => $tipusActivitat->nom,
            ]);
        }

        public static function updateTipusActivitat(Request $request){
            request()->validate([
                'nom' => 'required',
            ]);

            $tipusActivitat = new TipusActivitat([$request]);
            
            DB::table('tipus_activitat')
                ->where('tipus_activitat.id', $tipusActivitat->id)
                ->update([
                    'nom' => $tipusActivitat->nom,
                ]);
        }

        public static function eliminarTipusActivitat($id){
            DB::table('tipus_activitat')->delete($id);
        }

        /*****************
         * GESTIO EXTRES *
         *****************/

        /**
         * Funci?? per extreure tots els extres de la BBDD 
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

        public static function getExtresActivitat($id){
            $extres = ActivitatDAO::getExtres();

            foreach ($extres as $extra) {
                if (ActivitatDAO::isExtraActivitat($extra->id, $id))
                    $extra->setIdActivitat($id);
            }

            return $extres;
        }

        public static function isExtraActivitat($idExtra, $idActivitat){
            $res = DB::table('extres_activitats')
                    ->where('idExtra', $idExtra)
                    ->where('idActivitat', $idActivitat)
                    ->first();

            if ($res == null) return false;
            else return true;
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
         * Funci?? per a agafar tots els grups d'opcions
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
        
        public static function getGrupOpcionsActivitat($idActivitat){
            $grupOpcions = [];

            $activitat = ActivitatDAO::getActivitat($idActivitat);

            foreach (ActivitatDAO::getGrupOpcionsActivitatTipus('generals', $idActivitat) as $grup){
                $grup->setActivitat($activitat);
                $grupOpcions[] = $grup;
            }

            foreach (ActivitatDAO::getGrupOpcionsActivitatTipus('extres', $idActivitat) as $grup){
                $grup->setActivitat($activitat);
                $grupOpcions[] = $grup;
            }

            return $grupOpcions;
        }

        public static function getGrupOpcionsActivitatTipus($tipus, $idActivitat){
            $res = [];

            $grupOpcions = DB::table('opcions_'. $tipus . '_activitats')
                            ->join('opcions_'. $tipus, 'opcions_'. $tipus .'.id', '=', 'opcions_'. $tipus .'_activitats.idGrupOpcio')
                            ->where('idActivitat', $idActivitat)
                            ->get();
            
            foreach ($grupOpcions as $grups) {
                if ($tipus == 'extres') $grups->tipus = null;

                $obj = new GrupOpcio(array($grups));
                $res[] = $obj;
            }

            return $res;
        }

        /**
         * Funci?? per a agafar un grup d'opcions espec??fics
         * 
         * @param string $tipus Tipus de grup d'opcions
         * @param integer $id Identificador del grup d'opcions
         * 
         * @returns {GrupOpcio} Grup d'opcions espec??fic 
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
         * Funci?? per a insertar un grup d'opcions
         * 
         * @param Request $request El request del formulari
         * @param string $tipus Tipus de grup d'opcions
         * @param string $taulaActivitats Nom de la taula a la que es refereix
         */
        public static function insertarGrupOpcions(Request $request, $tipus, $taulaActivitats){
            // Creem l'objecte de grup opci??
            $grupOpcio = new GrupOpcio([$request]);

            // Creem l'objecte de l'activitat i l'afegim al grup opci??
            $activitat = ActivitatDAO::getActivitat($request->activitatOpcio);
            $grupOpcio->setActivitat($activitat);

            // Depenent del tipus de grup es far??n unes validacions o unes altres
            // I s'inserir?? en unes taules o unes altres
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

            return $activitat->id;
        }

        /**
         * Funci?? per a actualitzar un grup d'opcions
         * 
         * @param Request $request El request del formulari
         * @param string $tipus Tipus de grup d'opcions
         */
        public static function updateGrupOpcions(Request $request, $tipus){
            // Creem l'objecte de grup opci??
            $grupOpcio = new GrupOpcio([$request]);
            
            // Creem l'objecte de l'activitat i l'afegim al grup opci??
            $activitat = ActivitatDAO::getActivitat($request->activitatOpcio);
            $grupOpcio->setActivitat($activitat);
            
            // Depenent del tipus de grup es far??n unes validacions o unes altres
            // I s'inserir?? en unes taules o unes altres
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

            return $grupOpcio->activitat->id;
        }

        /**
         * Funci?? per eliminar un grup d'opcions
         * 
         * @param string $tipus Tipus de grup d'opcions
         * @param integer $id Identificador del grup d'opcions
         */
        public static function eliminarGrupOpcions($tipus, $id){
            $res = DB::table('opcions_' . $tipus . '_activitats')
                    ->where('idGrupOpcio', $id)
                    ->first();
                    
            $idActivitat = $res->idActivitat;

            DB::table('opcions_' . $tipus)->delete($id);

            return $idActivitat;
        }

        /******************
         * GESTIO OPCIONS *
         ******************/

        public static function getOpcions($idGrupOpcio, $tipus){
            $opcions = [];

            $res = DB::table($tipus . '_valors')
                        ->join('opcions_' . $tipus . '_valors', $tipus . '_valors.id', '=', 'opcions_' . $tipus . '_valors.id')
                        ->where('idGrupOpcio', $idGrupOpcio)
                        ->get();
            
            foreach ($res as $opcio){
                if ($tipus == 'extres'){
                    $obj = new Opcio();
                    $obj->setId($opcio->id);
                    $obj->setNom($opcio->nom);

                } else $obj = new Opcio(array($opcio));
                
                $opcions[] = $obj;
            }

            return $opcions;
        }

        public static function getOpcio($tipus, $idGrupOpcio, $id){
            $res = DB::table($tipus . '_valors')
                        ->join('opcions_' . $tipus . '_valors', $tipus . '_valors.idOpcioValor', '=', 'opcions_' . $tipus . '_valors.id')
                        ->where($tipus .'_valors.idGrupOpcio', $idGrupOpcio)
                        ->where($tipus .'_valors.idOpcioValor', $id)
                        ->first();
            
            if ($tipus == 'extres') {
                $opcio = new Opcio();
                $opcio->setId($res->id);
                $opcio->setNom($res->nom);
            } 
            else $opcio = new Opcio(array($res));

            return $opcio;
        }

        /**
         * Funci?? per insertar una opci?? general
         * 
         * @param Request $request Informaci?? del formulari
         */
        public static function insertarOpcioGeneral(Request $request){
            // Fem les validacions
            request()->validate([
                'nom'      => 'required',
                'preuSoci' => 'required',
                'tipus'    => 'required',
            ]);

            // Creem una inst??ncia de la opci??
            $opcio = new Opcio([$request]);
            
            // Inserim l'opci?? a la BBDD i agafem l'identificador
            $idOpcio = DB::table('opcions_generals_valors')->insertGetId([
                        'nom'      => $opcio->nom,
                        'preu'     => $opcio->preu,
                        'preuSoci' => $opcio->preuSoci,
                        'tipus'    => $opcio->tipus,
                    ]);

            // Agafem l'identificador del grup d'opcions al que perteneix
            $idGrupOpcio = $request->idGrupOpcio;

            // Afegim la relaci?? entre l'opci?? i el grup d'opcions
            ActivitatDAO::insertarRelacioOpcioGrupOpcio('generals', $idOpcio, $idGrupOpcio);
        }

        /**
         * Funci?? per insertar una opci?? extra
         * 
         * @param Request $request Informaci?? del formulari
         */
        public static function insertarOpcioExtra(Request $request){
            // Fem les validacions
            request()->validate([
                'nom' => 'required',
            ]);

            // Creem una inst??ncia de la opci??
            $opcio = new Opcio([$request]);

            // Inserim l'opci?? a la BBDD i agafem l'identificador
            $idOpcio = DB::table('opcions_extres_valors')->insertGetId([
                'nom' => $opcio->nom,
            ]);

            // Agafem l'identificador del grup d'opcions al que perteneix
            $idGrupOpcio = $request->idGrupOpcio;
            
            // Afegim la relaci?? entre l'opci?? i el grup d'opcions
            ActivitatDAO::insertarRelacioOpcioGrupOpcio('extres', $idOpcio, $idGrupOpcio);
        }

        public static function updateOpcioGeneral(Request $request){
            $opcio = new Opcio([$request]);
            
            DB::table('opcions_generals_valors')
                ->where('id', $opcio->id)
                ->update([
                    'nom'      => $opcio->nom,
                    'preu'     => $opcio->preu,
                    'preuSoci' => $opcio->preuSoci,
                    'tipus'    => $opcio->tipus,
                ]);
        }

        public static function updateOpcioExtra(Request $request){
            $opcio = new Opcio();
            $opcio->setId($request->id);
            $opcio->setNom($request->nom);

            DB::table('opcions_extres_valors')
                ->where('id', $opcio->id)
                ->update([
                    'nom' => $opcio->nom,
                ]);
        }

        /**
         * Funci?? per inserir la relaci?? entre l'opci?? i el grup d'opcions al que perteneix
         * 
         * @param string $tipus Tipus de opci??
         * @param integer $idOpcio Identificador de la opci??
         * @param integer $idGrupOpcio Identificador del grup d'opci??
         */
        public static function insertarRelacioOpcioGrupOpcio($tipus, $idOpcio, $idGrupOpcio){
            // Inserim a la taula depenent del tipus
            DB::table($tipus . '_valors')->insert([
                'idGrupOpcio'  => $idGrupOpcio,
                'idOpcioValor' => $idOpcio,
            ]);
        }

        public static function eliminarOpcio($tipus, $id){
            DB::table('opcions_' . $tipus . '_valors')->delete($id);
        }
    }