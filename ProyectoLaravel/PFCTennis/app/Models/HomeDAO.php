<?php
    namespace App\Models;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Usuari;
    use App\Models\ObjecteVista;
    use App\Models\Log;

    class HomeDAO {
        public static function getSliders(){
            $sliders = [];

            $res = DB::select('SELECT * FROM inici_vista');
            
            foreach ($res as $slider){
                $obj = new ObjecteVista($slider);
                $sliders[] = $obj;
            }

            return $sliders; 
        }

        public static function getCartes(){
            $cartes = [];
            $res = DB::select('SELECT * FROM cartes_inici_vista');
        
            foreach ($res as $carta){
                $obj = new ObjecteVista($carta);
                $cartes[] = $obj;
            }

            return $cartes;
        }
    }