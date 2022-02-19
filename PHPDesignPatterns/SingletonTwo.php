<?php

class Database{

    public static $connection;

    private function __construct(){
        echo "Connection!";
    }

    public static function connection(){
        if(!isset(self::$connection)){ 
            self::$connection = new Database(); 
        }
        return self::$connection;    
    }
}


Database::connection();