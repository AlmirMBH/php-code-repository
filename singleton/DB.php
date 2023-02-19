<?php

namespace App;


/**
 * Basic example of how singleton works, not a full case
 */
class DB{

    private static ?DB $instance = null;
    public static $counter = 1;

    private function __construct(public array $config){
        echo "Instance number ", self::$counter++, " created<br>";
    }


    public static function getInstance(array $config){
        
        if(self::$instance == null){
            self::$instance = new DB($config);
        }

        return self::$instance;
    }
}

$db1 = DB::getInstance([]);
$db2 = DB::getInstance([]);
$db3 = DB::getInstance([]);