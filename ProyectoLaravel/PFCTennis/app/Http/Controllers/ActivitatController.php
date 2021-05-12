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
    use App\Models\TipusActivitat;
    use App\Models\GrupOpcio;
    use App\Models\Opcio;
    
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
            $tipusActivitat = ActivitatDAO::getTipusActivitats();
            
            switch ($accio){
                case 'novaActivitat':
                    $extres = ActivitatDAO::getExtres();
                    
                    return view('AdminVista.formActivitat', ['accio' => 'novaActivitat', 'activitat' => new Activitat(), 'extres' => $extres, 'tipusActivitats' => $tipusActivitat]);
                    
                case'editarActivitat':
                    $extres = ActivitatDAO::getExtresActivitat($id);
                    $activitat = ActivitatDAO::getActivitat($id);

                    return view('AdminVista.formActivitat', ['accio' => 'editarActivitat', 'activitat' => $activitat, 'extres' => $extres, 'tipusActivitats' => $tipusActivitat]);
            }
        }

        public function insertarActivitat(Request $request){
            $idActivitat = ActivitatDAO::insertarActivitat($request);

            ActivitatDAO::insertarExtresActivitat($request, $idActivitat);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha registrat l\'activitat amb èxit!');
        }
        
        public function updateActivitat(Request $request){
            ActivitatDAO::updateActivitat($request);

            ActivitatDAO::updateExtresActivitat($request);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha actualitzat l\'activitat amb èxit!');    
        } 
        
        public function eliminarActivitat($id){
            ActivitatDAO::eliminarActivitat($id);

            return redirect()->route('activitats.activitats')->with('status', 'S\'ha eliminat l\'activitat amb èxit!');;
        }
        
        /**************************
         * GESTIO TIPUS ACTIVITAT *
         **************************/
        // TODO TERMINAR CON EL CRUD DE TIPO DE ACTIVIDAD: AÑADIR, EDITAR, ELIMINAR
        public function gestioTipusActivitat(){
            $tipusActivitats = ActivitatDAO::getTipusActivitats();
            
            return view('AdminVista.gestioTipusActivitat', compact('tipusActivitats'));
        }

        public function formulariTipusActivitat($accio, $id = null){
            switch ($accio){
                case 'nouTipusActivitat':
                    return view('AdminVista.formTipusActivitat', ['tipusActivitat' => new TipusActivitat(), 'accio' => $accio]);
                    
                case 'editarTipusActivitat':
                    // $tipusActivitat = ActivitatDAO::getTipusActivitat();

                    return view('AdminVista.formTipusActivitat', ['tipusActivitat' => new TipusActivitat(), 'accio' => $accio]);
            }
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

        public function gestioGrupOpcions($tipus){
            $grupOpcions = ActivitatDAO::getGrupOpcions($tipus);

            $grupOpcions = paginate($grupOpcions);

            return view('AdminVista.gestioGrupOpcions', ['grupOpcions' => $grupOpcions, 'tipus' => $tipus]);
        } 

        public function gestioGrupOpcionsActivitat($idActivitat){
            $grupOpcions = ActivitatDAO::getGrupOpcionsActivitat($idActivitat);
            $activitat = ActivitatDAO::getActivitat($idActivitat);

            return view('AdminVista.gestioGrupOpcions', ['grupOpcions' => $grupOpcions, 'tipus' => 'activitat', 'activitat' => $activitat]);
        }

        public function formulariGrupOpcio($tipus, $accio, $id = null){
            $activitats = ActivitatDAO::getActivitats();
            
            switch ($accio){
                case 'nouGrupOpcio':
                    return view('AdminVista.formGrupOpcions', ['tipus' => $tipus, 'accio' => $accio, 'grup' => new GrupOpcio(), 'activitats' => $activitats]);
                
                case 'editarGrupOpcio':
                    if ($tipus == 'extra') $plural = 'extres';
                    else if ($tipus == 'general') $plural = 'generals';
                    
                    $grup = ActivitatDAO::getGrupOpcio($plural, $id);
                    
                    return view('AdminVista.formGrupOpcions', ['tipus' => $tipus, 'accio' => $accio, 'grup' => $grup, 'activitats' => $activitats]);
            }
        }
    
        public function insertarGrupOpcions(Request $request, $tipus){

            switch ($tipus){
                case 'general':
                    $taulaActivitats = 'opcions_generals_activitats';
                    $plural = 'generals';
                    break;
                    
                case 'extra':
                    $taulaActivitats = 'opcions_extres_activitats';
                    $plural = 'extres';
                    break;
            }

            $idActivitat = ActivitatDAO::insertarGrupOpcions($request, $tipus, $taulaActivitats);
            
            return $this->gestioGrupOpcionsActivitat($idActivitat);
        }
    
        public function updateGrupOpcions(Request $request, $tipus){
            if ($tipus == 'extra') $plural = 'extres';
            else if ($tipus == 'general') $plural = 'generals';

            $idActivitat = ActivitatDAO::updateGrupOpcions($request, $plural);

            return $this->gestioGrupOpcionsActivitat($idActivitat);
        }
    
        public function eliminarGrupOpcions($tipus, $id){
            $idActivitat = ActivitatDAO::eliminarGrupOpcions($tipus, $id);

            return $this->gestioGrupOpcionsActivitat($idActivitat);
        }
    
        /******************
         * GESTIO OPCIONS *
         ******************/

        public function gestioOpcions($idGrupOpcio, $tipus){
            $opcions = ActivitatDAO::getOpcions($idGrupOpcio, $tipus);
            
            $grup = ActivitatDAO::getGrupOpcio($tipus, $idGrupOpcio);
            
            return view('AdminVista.gestioOpcions', ['tipus' => $tipus, 'opcions' => $opcions, 'grup' => $grup]);
        }

        public function formulariOpcio($idGrupOpcio, $tipus, $accio, $id = null){
            $grupOpcio = ActivitatDAO::getGrupOpcio($tipus, $idGrupOpcio);
            
            switch ($accio) {
                case 'novaOpcio':
                    
                    return view('AdminVista.formOpcio', ['tipus' => $tipus, 'accio' => $accio, 'grupOpcio' => $grupOpcio, 'opcio' => new Opcio()]);

                case 'editarOpcio':
                    $opcio = ActivitatDAO::getOpcio($tipus, $idGrupOpcio, $id);

                    return view('AdminVista.formOpcio', ['tipus' => $tipus, 'accio' => $accio, 'grupOpcio' => $grupOpcio, 'opcio' => $opcio]);
            }
        }

        public function insertarOpcio(Request $request, $tipus){
            switch ($tipus){
                case 'generals':
                case 'general':
                    ActivitatDAO::insertarOpcioGeneral($request);
                    
                    return redirect()->route('activitats.opcions', ['idGrupOpcio' => $request->idGrupOpcio, 'tipus' => 'generals'] )->with('status', 'S\'ha afegit l\'opció amb èxit!');
                    
                case 'extres':
                case 'extra':
                    ActivitatDAO::insertarOpcioExtra($request);

                    return redirect()->route('activitats.opcions', ['idGrupOpcio' => $request->idGrupOpcio, 'tipus' => 'extres'] )->with('status', 'S\'ha afegit l\'opció amb èxit!');
            }
        }

        public function updateOpcio(Request $request, $tipus){
            switch ($tipus) {
                case 'generals':
                    request()->validate([
                        'nom'      => 'required',
                        'preuSoci' => 'required',
                        'preu'     => 'required',
                        'tipus'    => 'required',
                    ]);

                    ActivitatDAO::updateOpcioGeneral($request);
                    break;
                    
                case 'extres':
                    request()->validate([
                        'nom' => 'required',
                    ]);

                    ActivitatDAO::updateOpcioExtra($request);
                    break;
            }

            return redirect()->route('activitats.opcions', ['idGrupOpcio' => $request->idGrupOpcio, 'tipus' => $tipus] )->with('status', 'S\'ha modificat l\'opció amb èxit!');
        }

        public function eliminarOpcio($tipus, $id, $idGrupOpcio){
            ActivitatDAO::eliminarOpcio($tipus, $id);

            return redirect()->route('activitats.opcions', ['idGrupOpcio' => $idGrupOpcio, 'tipus' => $tipus] )->with('status', 'S\'ha eliminat l\'opció amb èxit!');
        }
    }