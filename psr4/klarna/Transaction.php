<?php

declare(strict_types = 1);

namespace Klarna;

use DateTime;


class Transaction{

    /**
     * The '\' tells PHP that the class is in the global namespace, otherwise an error is thrown. 
     * This is the case with e.g. Laravel's Exception class.
     * Another way is to import the DateTime with the key word 'use'.
     * If functions and constants are not in the local namespace PHP will automatically look for them in the
     * global namespace.
     * If a local function has the same name sa a PHP native function the local function will be called e.g.
     * see implode function below. In order to avoid it use the '\' in front of the function name.
     * 
     * It might be a good practice to always use '\' with PHP native functions as PHP will not have to resolve
     * them but it will immediately know where the functions are.
    */
    public function __construct(){    
        var_dump(new CustomerProfile());
        echo "<br>";
        var_dump(new DateTime()); // if not imported, use '\DateTime()'
        echo "<br>";
        var_dump(\explode(', ', 'Hello world'));
        echo "<br>";
        var_dump(implode(': ', [1, 2, 3]));
        echo "<br>";
    }

}


function explode($separator, $string){
    return "exploding";
}


function implode($separator, $string){
    return "imploding";
}


function pay(){
    echo "Paid with Klarna";
}