<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class HomeDAO {
        public static function getObjecteVista($taula){
            $objectes = [];

            $res = DB::table($taula)->get();
            
            foreach ($res as $obj){
                $instancia = new ObjecteVista($obj);
                $objectes[] = $instancia;
            }

            return $objectes; 
        }

    }