<?php

require_once('../controllers/users.controller.php');
require_once('../models/users.model.php');

class AjaxUsersDatatable {

    public function ajaxViewUsers() {

        $value = null;
        $response = ControllerUsers::ctrViewUsers($value);

        $datosJson = '{
                    "data": [ ';

        for ($i=0; $i < count($response) ; $i++) { 

            $actions = "<div class='btn-group' role='group' aria-label='Third group'><button type='button' tipo='edit' class='btn btn-warning btn-sm btnEdit' idUser='".$response[$i]["id"]."'><i class='fas fa-edit' idUser='".$response[$i]["id"]."' tipo='edit'></i></button><button type='button' tipo='del' class='btn btn-danger btn-sm btnRemove' idUser='".$response[$i]["id"]."'><i class='fas fa-trash' idUser='".$response[$i]["id"]."' tipo='del'></i></button></div>";
                
            $datosJson .= '[
                "'.$response[$i]["id"].'",
                "'.$response[$i]["user"].'",
                "'.$response[$i]["name"].'",
                "'.$actions.'"
            ],';

        }

        $datosJson = substr(($datosJson), 0 ,-1);

        $datosJson .= '] }';

        echo $datosJson;

    }

}

$viewUsers = new AjaxUsersDatatable();
$viewUsers -> ajaxViewUsers();