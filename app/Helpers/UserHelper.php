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
            for ($u = 1; $u < 10; $u ++) {
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
            Session::put('next_id', sizeof($users) + 1);
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

    public static function saveUser($pseudo_user) {
        $user = new UserCommand();
        $user -> username = $pseudo_user -> username;
        $user -> address = $pseudo_user -> address;
        $user -> email = $pseudo_user -> email;
        $user -> fecha = $pseudo_user -> fecha;
        $user -> municipi = SelectHelper::getMunicipiById($pseudo_user -> municipi -> id);
        $user -> actiu = $pseudo_user -> actiu;

        $users = UserHelper::getAllUsers();
        $user -> id = UserHelper::getNextUsuariId();

        array_push($users,$user);
        Session::put('users', $users);
    }

    public static function updateUser($pseudo_user) {
        $users = UserHelper::getAllUsers();
        $found = false;

        foreach ($users as &$user) {
            if (!$found && $user -> id == $pseudo_user -> id) {
                $user -> username = $pseudo_user -> username;
                $user -> address = $pseudo_user -> address;
                $user -> email = $pseudo_user -> email;
                $user -> fecha = $pseudo_user -> fecha;
                $user -> municipi = SelectHelper::getMunicipiById($pseudo_user -> municipi -> id);
                $user -> actiu = $pseudo_user -> actiu;

                $found = true;
            }
        }
        Session::put('users', $users);
    }

    public static function deleteUserById($id) {
        $users = UserHelper::getAllUsers();
        $found = false;

        for ($u=0; ($u<sizeof($users) && !$found); $u++) {
            if (array_key_exists($u,$users) && $users[$u] -> id == $id) {
                array_splice($users,$u,1);
                $found = true;
            }
        }
        Session::put('users', $users);
    }

    private static function getNextUsuariId() {
        if (Session::has('next_id')) {
            $actualId = Session::get('next_id');
            Session::put('next_id', $actualId + 1);
            return $actualId;
        } else {
            return 1;
        }
    }
}