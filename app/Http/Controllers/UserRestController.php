<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Helpers\SelectHelper;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserRestController extends Controller
{

    public function listAllUsers() {
        return UserHelper::getAllUsers();
    }

    public function getUser ($id) {
        $user = UserHelper::findById($id);
        return $user;
    }

    public function createUser(Request $request) {
        $pseudo_user = json_decode($request->getContent());
        UserHelper::saveUser($pseudo_user);
    }

    public function updateUser(Request $request, $id) {
        $user = UserHelper::findById($id);
        if ($user != null) {
            $pseudo_user = json_decode($request->getContent());
            UserHelper::updateUser($pseudo_user);
        }
    }

    public function getAllMunicipis() {
        $munis = SelectHelper::getAllMunicipis();
        return $munis;
    }


}
