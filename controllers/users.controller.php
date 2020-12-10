<?php

class ControllerUsers {

    static public function ctrViewUsers($value){

        $table = 'usuarios';

        $response = ModelUsers::mdlViewUsers($table, $value);

        return $response;

    }

    static public function ctrDeleteUser($value) {

        $table = 'usuarios';

        $response = ModelUsers::mdlDeleteUser($table, $value);

        return $response;

    }
    
    static public function ctrAddUser($value) {

        $table = 'usuarios';

        extract($value);

        $passCrypt = crypt($pass, '2a$07$estoestareeeebuenov1z3$');

        $value2 = array(
            "user" => $user,
            "pass" => $passCrypt,
            "name" => $name
        );

        $response = ModelUsers::mdladdUser($table, $value2);

        return $response;

    }
    
    static public function ctrEditUser($value) {

        $table = 'usuarios';

        extract($value);

        if ($modify === 'yes') {
            $passCrypt = crypt($pass, '2a$07$estoestareeeebuenov1z3$');
        } else {
            $passCrypt = $pass;
        }        

        $value2 = array(
            "tokken" => $tokken,
            "user" => $user,
            "pass" => $passCrypt,
            "name" => $name
        );

        $response = ModelUsers::mdlEditUser($table, $value2);

        return $response;

    }

}