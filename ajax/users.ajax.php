<?php

require_once('../controllers/users.controller.php');
require_once('../models/users.model.php');

// error_reporting(0);
// header('Content-type: application/json; charset=utf-8');

class AjaxUsers {

    public $id;
    public $user;
    public $pass;
    public $name;
    public $modify;

    public function ajaxViewUser() {

        $value = $this->id;

        $response = ControllerUsers::ctrViewUsers($value);
        
        echo json_encode($response);

    }

    public function ajaxDeleteUser() {

        $value = $this->id;

        $response = ControllerUsers::ctrDeleteUser($value);
        
        echo $response;

    }

    public function ajaxAddUser() {

        $value = array(
            "user" => $this->user,
            "pass" => $this->pass,
            "name" => $this->name
        );

        $response = ControllerUsers::ctrAddUser($value);
        
        echo $response;

    }

    public function ajaxEditUser() {

        $value = array(
            "tokken" => $this->id,
            "user" => $this->user,
            "pass" => $this->pass,
            "modify" => $this->modify,
            "name" => $this->name
        );

        $response = ControllerUsers::ctrEditUser($value);
        
        // echo $response;
        echo json_encode($response);

    }

}

if(isset($_POST["id"])){
    $delete = new AjaxUsers();
    $delete->id = $_POST["id"];
    $delete->ajaxDeleteUser();
}

if(isset($_POST["user"])){
    $add = new AjaxUsers();
    $add->user = $_POST["user"];
    $add->pass = $_POST["password"];
    $add->name = $_POST["name"];
    $add->ajaxAddUser();
}

if (isset($_POST["tokken"])) {
    $view = new AjaxUsers();
    $view->id = $_POST["tokken"];
    $view->ajaxViewUser();
}
if (isset($_POST["tokkenEdit"])) {
    $edit = new AjaxUsers();
    $edit->id = $_POST["tokkenEdit"];
    $edit->user = $_POST["userEdit"];
    $edit->pass = $_POST["passwordEdit"];
    $edit->name = $_POST["nameEdit"];
    $edit->modify = $_POST["modify"];
    $edit->ajaxEditUser();
}

