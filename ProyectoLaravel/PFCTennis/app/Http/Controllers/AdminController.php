<?php

    namespace App\Http\Controllers;

    use App\Models\AdminDAO;
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
                    //TODO CREAR LA FUNCIÓN PARA OBTENER USUARIO
                    $usuari = AdminDAO::getUsuari();
                    return view('AdminVista.formUsuari', ['accio' => $accio, 'id' => $id, 'usuari' => $usuari]);
                
                default:
                    return redirect('dashboard');
            }

        }

        public function registrar(Request $request){
            AdminDAO::insertarUsuari($request);

            return redirect()->route('gestioUsuaris');
        }

    }