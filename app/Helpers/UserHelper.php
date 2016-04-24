<?php
/**
 * Created by PhpStorm.
 * User: Logan
 * Date: 24/04/2016
 * Time: 16:23
 */
namespace App\Helpers;

use App\UserCommand;
use DateTime;
use Illuminate\Support\Facades\Session;

class UserHelper {
    public static function getAllUsers() {
        $users = [];
        if (Session::has('users')) {
            $users = Session::get('users');
        } else {
            for ($u = 1; $u < 20; $u ++) {
                $user = new UserCommand();

                $user -> id = $u;
                $user -> address = "Adreça " . $u;
                $user -> email = "usuari" . $u . "@limit.es";
                $user -> username = "Usuari " . $u;

                $fecha = new DateTime();
                $user -> fecha = $fecha->getTimestamp();

                $muni_id = rand(1, 10);
                $user -> municipi = SelectHelper::getMunicipiById($muni_id);

                if ($muni_id > 4)
                    $user -> actiu = true;
                else
                    $user -> actiu = false;

                array_push($users, $user);
            }

            Session::put('users',$users);
        }

        return $users;
    }

    public static function findById ($id) {
        $users = UserHelper::getAllUsers();
        $final_user = null;
        foreach($users as $user) {
            if ($user -> id == $id) {
                $final_user = $user;
            }
        }
        return $final_user;
    }
}