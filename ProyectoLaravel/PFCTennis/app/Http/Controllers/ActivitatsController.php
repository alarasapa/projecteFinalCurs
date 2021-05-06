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
    
    class ActivitatsController extends Controller {
    
        public function gestioExtres(){
            // Agafem els usuaris 
            $extres = ActivitatDAO::getExtres();

            $extres = paginate($extres);

            // Retornem a la vista amb l'array d'usuaris com a paràmetre
            return view('AdminVista.gestioExtres', compact('extres'));
        }

        public function formulariActivitat($accio, $id = null){
            switch ($accio){
                case 'novaActivitat':
                    $extres = ActivitatDAO::getExtres();

                    return view('AdminVista.formActivitat', ['accio' => 'novaActivitat', 'activitat' => new Activitat(), 'extres' => $extres]);
                    break;

                case'editarActivitat':
                    break;
            }
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
    }