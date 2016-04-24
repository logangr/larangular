<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Helpers\SelectHelper;
use App\Http\Requests;

class UserRestController extends Controller
{

    public function listAllUsers() {
        return UserHelper::getAllUsers();
    }

    public function getUser ($id) {
        $user = UserHelper::findById($id);
        return $user;
    }

    public function getAllMunicipis() {
        $munis = SelectHelper::getAllMunicipis();
        return $munis;
    }
}
