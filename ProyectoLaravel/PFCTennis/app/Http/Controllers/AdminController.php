<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class AdminController extends Controller {

        public function __constructor(){

        }

        /**
         * Aquestes funcions redireccionen a pàgines 
         * relacionades amb l'administració de la pàgina web
         */

        public function dashboard(){
            $logsUsuaris = [];

            $res = DB::select('SELECT lg.id, lg.descripcio, lg.data, u.id, u.nom, u.cognoms, u.contrasenya, u.rol, u.email, u.telefon, u.dataNaixement, u.dataCreacio 
                FROM log_usuari lg INNER JOIN usuari u ON lg.idUsuari = u.id ORDER BY lg.data');
    
            foreach ($res as $log){
                $usuariObj = new Usuari(array($log));
                $logObj = new Log($log, $usuariObj);
                $logsUsuaris[] = $logObj;
            }
    
            return view('AdminVista.dashboard', compact('logsUsuaris'));
        }

        public function gestioUsuaris(){
            return view('AdminVista.gestioUsuaris');
        }

    }