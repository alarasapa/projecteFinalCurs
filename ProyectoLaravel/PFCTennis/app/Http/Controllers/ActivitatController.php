<?php

    namespace App\Http\Controllers;

    use App\Models\AdminDAO;
    use App\Models\ActivitatDAO;
    use App\Models\HomeDAO;
    use Illuminate\Http\Request;
    use App\Models\Usuari;
    use App\Models\Log;
    use App\Models\ObjecteVista;
    use App\Models\Localitzacio;
    use App\Models\Activitat;
    use App\Models\Extra;
    use App\Models\GrupOpcio;
    
    class ActivitatController extends Controller {
    
        /*********************
         * GESTIO ACTIVITATS *
         *********************/

        /**
         * Funció per a mostar totes les activitats
         */
        public function gestioActivitats(){
            // Agafem les activitats
            $activitats = ActivitatDAO::getActivitats();

            // Les paginem
            $activitats = paginate($activitats);

            // Retornem la vista
            return view('AdminVista.gestioActivitats', compact('activitats'));
        }

        /**
         * Funció per a mostrar el formulari de la activitat
         */
        public function formulariActivitat($accio, $id = null){
            switch ($accio){
                case 'novaActivitat':
                    // $extres = ActivitatDAO::getExtres();
                    
                    return view('AdminVista.formActivitat', ['accio' => 'novaActivitat', 'activitat' => new Activitat()]);
                    
                case'editarActivitat':
                    $activitat = ActivitatDAO::getActivitat($id);

                    return view('AdminVista.formActivitat', ['accio' => 'editarActivitat', 'activitat' => $activitat]);
            }
        }

        public function insertarActivitat(Request $request){
            ActivitatDAO::insertarActivitat($request);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha registrat l\'activitat amb èxit!');
        }
        
        public function updateActivitat(Request $request){
            ActivitatDAO::updateActivitat($request);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha actualitzat l\'activitat amb èxit!');    
        } 
        
        public function eliminarActivitat($id){
            ActivitatDAO::eliminarActivitat($id);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha eliminat l\'activitat amb èxit!');;
        }
        
        /*****************
         * GESTIO EXTRES *
         *****************/

        public function gestioExtres(){
            // Agafem els usuaris 
            $extres = ActivitatDAO::getExtres();

            $extres = paginate($extres);

            // Retornem a la vista amb l'array d'usuaris com a paràmetre
            return view('AdminVista.gestioExtres', compact('extres'));
        }
                
        public function formulariExtra($accio, $id = null){
            switch ($accio){
                case 'nouExtra':
                    return view('AdminVista.formExtra', ['accio' => 'nouExtra', 'extra' => new Extra()]);

                case'editarExtra':
                    $extra = ActivitatDAO::getExtra($id);

                    return view('AdminVista.formExtra', ['accio' => 'editarExtra', 'extra' => $extra]);
            }
        }

        public function insertarExtra(Request $request){
            ActivitatDAO::insertarExtra($request);

            return redirect()->route('activitats.extres')->with('status', 'S\'ha registrat l\'extra amb èxit!');
        }

        public function updateExtra(Request $request){
            ActivitatDAO::updateExtra($request);

            return redirect()->route('activitats.extres')->with('status', 'S\'ha actualitzat l\'extra amb èxit!');    
        }

        public function eliminarExtra($id){
            ActivitatDAO::eliminarExtra($id);

            return redirect()->route('activitats.extres')->with('status', 'S\'ha eliminat l\'extra amb èxit!');    
        }
    
        /***********************
         * GESTIO GRUP OPCIONS *
         ***********************/
        //TODO falta controlar que las actividades, extras... cuando se de el caso que no hay en la bbdd
        public function formulariGrupOpcio($tipus, $accio, $id = null){
            $activitats = ActivitatDAO::getActivitats();
            
            switch ($accio){
                case 'nouGrupOpcio':

                    return view('AdminVista.formGrupOpcions', ['tipus' => $tipus, 'accio' => $accio, 'grup' => new GrupOpcio(), 'activitats' => $activitats]);
                
                case 'editarGrupOpcio':
                    break;
            }
        }
    
        public function insertarGrupOpcions(Request $request, $tipus){

            switch ($tipus){
                case 'general':
                    $taulaActivitats = 'opcions_generals_activitats';
                    break;

                case 'extra':
                    $taulaActivitats = 'opcions_extres_activitats';
                    break;
            }
            
            ActivitatDAO::insertarGrupOpcions($request, $tipus, $taula, $taulaActivitats);

            // return redirect()->route()->with('status', 'S\'ha afegit el grup d\'activitats amb èxit!');
        }
    
    
    
    
    
    
    }