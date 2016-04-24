<?php

namespace App;


class UserCommand
{
    public $id;

    public $username;

    public $address;

    public $email;

    public $fecha;

    public $municipi;

    public $actiu;

    function __construct1(){
        $this -> id = 0;
    }

    function __construct2($id, $username, $address, $email, $fecha, $municipi, $actiu) {
        $this -> id = $id;
        $this -> username = $username;
        $this -> address = $address;
        $this -> email = $email;
        $this -> fecha = $fecha;
        $this -> municipi = $municipi;
        $this -> actiu = $actiu;
    }
}
