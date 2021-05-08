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
    use App\Models\Localitzacio;

    class ActivitatDAO {
        
         /*********************
         * GESTIO ACTIVITATS *
         *********************/

        public static function getActivitats(){
            $activitats = [];

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
            $extres = [];

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

        public static function insertarGrupOpcions(Request $request, $tipus, $taulaActivitats){
            if ($tipus == 'general'){
                request()->validate([
                    'titol'        => 'required',
                    'descripcio'   => 'required',
                    'tipusOpcions' => 'required',
                ]);

            } else if ($tipus == 'extra'){
                request()->validate([
                    'titol'        => 'required',
                    'descripcio'   => 'required',
                ]);
            }
            
            // DB::table($taula)->insert([]);
        }
    }