<?php
// this block of code is usually in a separate file and included 
// in different files via include
// Note for Linux with namespaces: As Linux uses forward slashes for file directories, 
// $fullpath = str_replace('\\', '/', $fullpath) should be added 

// either specify: use Client\Person; 
// or use 'Client' namespace in the object instantiation 
// e.g. $person = new Client\Person ("John", 42);

    spl_autoload_register('autoloader');

    function autoloader($className){
        
        // $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        // if(strpos($url, 'autoload') !== false){
        //     $path = 'classes/';
        // }

        $path = "classes/";        
        $extension = ".php";
        $fullPath = $path . $className . $extension;        
        $fullPath = str_replace('\\', '/', $fullPath); // needed for Linux

        if(!file_exists($fullPath)){
            echo "File " . $className . $extension . " does not exist!";
            return false;
        }
        include_once $fullPath;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head><title>Autoload</title>
</head>
<body>
    <h1>Autoload</h1>

    <?php

    
        $person = new Client\Person ("John", 42);
        $house = new House("Sarajevo street", 44);

        // echo $person->getPerson();       
        echo $house->getHouse();

    ?>
    
</body>
</html>