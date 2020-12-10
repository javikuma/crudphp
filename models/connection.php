<?php

class Connection {

    static public function connect() {

        $host = 'localhost';
        $dbname = 'ajax_data';
        $user = 'root';
        $pass = '';

        try {

            $link = new PDO(
                "mysql:host=".$host.";dbname=".$dbname,
                $user,
                $pass 
            );
    
            $link->exec( 'set names utf8' );
    
            return $link;
            
        } catch (PDOException $e) {
            echo 'ERROR: '. $e->getMessage();
            die();
        }

    }

}