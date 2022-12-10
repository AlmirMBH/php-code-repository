<?php

/**
 * PHP stores global variables in associative array called $GLOBALS and they can be accessed as key value pairs
 */
echo "<br>VARIABLE SCOPE<br>";
$r = 5;
function getVariable(){
    global $r;
    $r = 10; // reference to the original variable in line 4 (changed to 10)
    echo $r, "<br>";
    $GLOBALS['r'] = 12;
    echo $GLOBALS['r'], "<br>";
}
getVariable();
echo $r;


echo "<br>STATIC VARIABLES<br>";
function getValue(){
    // if 'static' is removed the execution time will be multiplied by the number of function calls
    static $value = null;
    if($value === null){
        $value = someVeryExpensiveFunction();
    }
    
    return $value;
}


function someVeryExpensiveFunction(){
    sleep(1);
    echo "Processing<br>"; // called only once
    return 10;
}

// Simulation of multiple function calls in various files
echo getValue(), "<br>";
echo getValue(), "<br>";
echo getValue(), "<br>";
echo getValue(), "<br>";