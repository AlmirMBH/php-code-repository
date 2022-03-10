<?php

class Database{

    public static $connection;

    private function __construct(){
        echo "Connection!";
    }

    public static function connection(){
        if(!isset(self::$connection)){ 
            self::$connection = new Database(); 
        }else{
            echo "DB object has already been created, use it!";
        }
        return self::$connection;    
    }
}


Database::connection();
Database::connection();
Database::connection();
Database::connection();