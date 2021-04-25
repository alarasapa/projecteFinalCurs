<?php

    namespace App\Http\Controllers;

    use App\Models\AdminDAO;
    use App\Models\HomeDAO;
    use Illuminate\Http\Request;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;


    class AdminController extends Controller {

        public function __constructor(){}

        /**
         * Aquestes funcions redireccionen a pàgines 
         * relacionades amb l'administració de la pàgina web
         */

        public function dashboard(){
            $logsUsuaris = AdminDAO::getLogsAdmins();
    
            return view('AdminVista.dashboard', compact('logsUsuaris'));
        }

        /**
         * Funció per a obtenir usuaris i retornar-los a la vista
         * 
         * @return View Retornem una vista
         */
        public function gestioUsuaris(){
            // Agafem els usuaris 
            $usuaris = AdminDAO::getUsuaris();

            // Retornem a la vista amb l'array d'usuaris com a paràmetre
            return view('AdminVista.gestioUsuaris', compact('usuaris'));
        }

        /**
         * Funció per a redirigir al formulari d'usuaris
         * 
         * @param String $accio El tipus de formulari que es vol fer
         * @param Integer $id Identificador de l'usuari
         * 
         * @return View Retorna una vista 
         */
        public function formulariUsuari($accio, $id = null){
            // Segons el tipus d'acció que s'ha passat per paràmetre
            switch ($accio){
                case "nouUsuari":
                    // Si és un nou usuari creem una instància buida
                    $usuari = new Usuari();
                    // I retornem la vista
                    return view('AdminVista.formUsuari', ['accio' => $accio, 'id' => $id, 'usuari' => $usuari]);
                
                case "editarUsuari":
                    // Si es vol editar un, cridem la funció per a agafar-lo de la base de dades
                    $usuari = AdminDAO::getUsuari($id);
                    // I retornem la vista
                    return view('AdminVista.formUsuari', ['accio' => $accio, 'id' => $id, 'usuari' => $usuari]);
            }

        }

        /**
         * Funció per redireccionar al formulari de vistes
         * 
         * @param String $accio Tipus de formulari
         * @param String $tipus Tipus d'objecte
         * @param Integer $id Identificador del objecte
         */
        public function formulariVista($accio, $tipus, $id = null){

            switch ($accio){
                case "nouVista":
                    return view('AdminVista.formVista', ['accio' => 'nouVista', 'tipus' => $tipus, 'vista' => new ObjecteVista()]);
                    
                case "editarVista":
                    $objecte = AdminDAO::getObjecteVista($tipus, $id);
                    return view('AdminVista.formVista', ['accio' => 'editarVista', 'tipus' => $tipus, 'vista' => $objecte]);
            }

        }

        /**
         * Funció per a registrar un usuari
         * 
         * @param Request $request Informació del formulari
         * 
         * @return Route Redireccionament
         */
        public function registrar(Request $request){
            // Cridem la funció per a afegir a la base de dades
            AdminDAO::insertarUsuari($request);

            // Redireccionem al gestor d'usuaris
            return redirect()->route('gestioUsuaris');
        }

        /**
         * Funció per actualitzar les dades d'un usuari
         * 
         * @param Request $request Informació del formulari
         * 
         * @return Route Redireccionament
         */
        public function actualizar(Request $request){
            // Actualitzem les dades
            AdminDAO::updateUsuari($request);

            // Redireccionem al gestor d'usuaris
            return redirect()->route('gestioUsuaris');
        }

        /**
         * Funció per eliminar un usuari
         * 
         * @param Request $request Informació del formulari
         */
        public function eliminar(Request $request){
            // Eliminem l'usuari
            AdminDAO::eliminarUsuari($request->id);

            return redirect()->route('gestioUsuaris');
        }

        /**
         * Funció per agafar tots els sliders
         * 
         * @return View Retorna una vista
         */
        public function getSliders(){
            // Inicialitzem la array
            $sliders = [];
            // Agafem els sliders en la base de dades
            $sliders = HomeDAO::getLlistatObjecteVista('inici_vista');

            // Retornem la vista amb les dades
            return view('AdminVista.gestioVista', ['tipus' => 'slider', 'llista' => $sliders]);
        }
        
        /**
         * Funció per agafar tots les cartes
         * 
         * @return View Retorna una vista
         */
        public function getCartes(){
            // Inicialitzem la array
            $cartes = [];
            // Agafem les cartes en la base de dades
            $cartes = HomeDAO::getLlistatObjecteVista('cartes_inici_vista');
            
            // Retornem la vista amb les dades
            return view('AdminVista.gestioVista', ['tipus' => 'cartes', 'llista' => $cartes]);
        }

    }