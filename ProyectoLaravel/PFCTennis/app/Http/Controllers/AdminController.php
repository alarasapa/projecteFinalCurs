<?php

    namespace App\Http\Controllers;

    use App\Models\AdminDAO;
    use App\Models\HomeDAO;
    use Illuminate\Http\Request;
    use App\Models\Usuari;

    class AdminController extends Controller {

        public function __constructor(){}

        /**
         * Aquestes funcions redireccionen a pàgines 
         * relacionades amb l'administració de la pàgina web
         */

        public function dashboard(){
            $logsUsuaris = AdminDAO::getLogsUsuari();
    
            return view('AdminVista.dashboard', compact('logsUsuaris'));
        }

        /**
         * Funció per a obtenir usuaris i retornar-los a la vista
         */
        public function gestioUsuaris(){
            $usuaris = AdminDAO::getUsuaris();

            // Retornem a la vista amb l'array d'usuaris com a paràmetre
            return view('AdminVista.gestioUsuaris', compact('usuaris'));
        }

        public function formulariUsuari($accio, $id = null){
            switch ($accio){
                case "nouUsuari":
                    $usuari = new Usuari();
                    return view('AdminVista.formUsuari', ['accio' => $accio, 'id' => $id, 'usuari' => $usuari]);
                
                case "editarUsuari":
                    $usuari = AdminDAO::getUsuari($id);
                    return view('AdminVista.formUsuari', ['accio' => $accio, 'id' => $id, 'usuari' => $usuari]);
                
                default:
                    return redirect('gestioUsuaris');
            }

        }

        public function registrar(Request $request){
            AdminDAO::insertarUsuari($request);

            return redirect()->route('gestioUsuaris');
        }

        public function actualizar(Request $request){
            AdminDAO::updateUsuari($request);

            return redirect()->route('gestioUsuaris');
        }

        public function eliminar(Request $request){
            AdminDAO::eliminarUsuari($request->id);

            return redirect()->route('gestioUsuaris');
        }

        public function getSliders(){
            $sliders = [];
            $sliders = HomeDAO::getSliders();

            return view('AdminVista.slider', compact('sliders'));
        }

    }