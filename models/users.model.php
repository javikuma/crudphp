<?php

require_once('connection.php');

class ModelUsers{

    static public function mdlViewUsers($table, $value) {

        if ($value == null) {
            
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            
            return $stmt->fetchAll();
        
        } else {

            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE id = :id");

            $stmt->bindParam(":id", $value, PDO::PARAM_STR);

            $stmt->execute();
            
            return $stmt->fetch();

        }

        $stmt->close();
        $stmt = null;

    }

    static public function mdlDeleteUser($table, $value) {

        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $value, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "o";
        } else {
            return "e";
        }
    
    }
    
    static public function mdladdUser($table, $value) {

        $stmt = Connection::connect()->prepare("INSERT INTO $table(user, password, name) VALUES ( :user, :pass, :name )");

        $stmt->bindParam(":user", $value["user"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $value["pass"], PDO::PARAM_STR);
        $stmt->bindParam(":name", $value["name"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "o";
        } else {
            return "e";
        }
    
    }
    
    static public function mdlEditUser($table, $value) {

        $stmt = Connection::connect()->prepare("UPDATE $table SET user = :user, password = :pass, name = :name WHERE id = :id ");

        $stmt->bindParam(":id", $value["tokken"], PDO::PARAM_INT);
        $stmt->bindParam(":user", $value["user"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $value["pass"], PDO::PARAM_STR);
        $stmt->bindParam(":name", $value["name"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "o";
        } else {
            return "e";
        }
    
    }

}