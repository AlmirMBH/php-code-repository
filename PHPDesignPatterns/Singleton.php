<?php
//_________________________________________________SINGLETON____________________________________________________
// Global object for database connections to avoid creating many objects is easily accessed from any part of the app
// Instead, SIGLETONS are used and whenever we create a new object, we actually get the existing one - SINGLETON 
// SINGLETON can't be overridden and it has a PRIVATE constructor and a static function to get object

class DBConnection{
    
    private function __construct(){
        echo "New object created".PHP_EOL;
    }
    
    public static function getInstance(){
        
        static $instance = null;
        
        if($instance == null){
            $instance = new static();
        }else{
            echo "Using the same object".PHP_EOL;
        }
        return $instance;
    }
}

// run in the console
DBConnection::getInstance();
DBConnection::getInstance();
DBConnection::getInstance();