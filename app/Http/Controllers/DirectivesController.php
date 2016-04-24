<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Helpers\SelectHelper;
use App\Http\Requests;

class DirectivesController extends Controller
{

    public function user() {
        return UserHelper::getAllUsers();
    }

}
