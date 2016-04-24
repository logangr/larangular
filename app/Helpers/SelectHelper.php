<?php
/**
 * Created by PhpStorm.
 * User: Logan
 * Date: 24/04/2016
 * Time: 16:46
 */

namespace App\Helpers;

use App\MunicipiUsuari;
use Illuminate\Support\Facades\Session;

class SelectHelper {

    public static function getAllMunicipis() {

        $munis = [];

        if (Session::has('munis')) {
            $munis = Session::get('munis');
        }else{
            array_push($munis, new MunicipiUsuari(1, "Palma de Mallorca"));
            array_push($munis, new MunicipiUsuari(2, "Manacor"));
            array_push($munis, new MunicipiUsuari(3, "Binissalem"));
            array_push($munis, new MunicipiUsuari(4, "Santa Maria del camí"));
            array_push($munis, new MunicipiUsuari(5, "Sa Pobla"));
            array_push($munis, new MunicipiUsuari(6, "Sant Joan"));
            array_push($munis, new MunicipiUsuari(7, "Porto Cristo"));
            array_push($munis, new MunicipiUsuari(8, "Consell"));
            array_push($munis, new MunicipiUsuari(9, "Marratxí"));
            array_push($munis, new MunicipiUsuari(10,"Altres"));

            Session::put('munis',$munis);
        }

        return $munis;
    }

    public static function getMunicipiById ($id) {
        $munis = SelectHelper::getAllMunicipis();
        $final_muni = null;
        foreach($munis as $muni) {
            if ($muni->id == $id) {
                $final_muni = $muni;
            }
        }
        return $final_muni;
    }
}