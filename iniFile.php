<?php

/**
 * https://www.php.net/manual/en/ini.list.php
 * Not all the directives can be updated during the runtime, only through the php ini file
 * i.e. if a property in the column 'Changeable' has values: PHP_INI_PERDIR or PHP_INI_SYSTEM. 
 * Values of those properties that are modified during the runtime will be effective only during the 
 * script execution.
 * Update of the ini.php file requires server restart.
 */


echo "MAX EXECUTION TIME<br>";  
ini_set('max_execution_time', 3);
sleep(1);
echo "Just woke up!<br>";


echo "<br>MEMORY LIMIT<br>";
var_dump(ini_get('memory_limit'));

$string = 'x';

// var_dump(ini_set('memory_limit', -1)); // remove limit (not recommended)
for($i = 0; $i < 10; $i++){ // change 10 to 100 and the memory limit will be reached
  $string .= $string;
}

echo $string, "<br>";


/**
 * https://www.php.net/manual/en/errorfunc.constants.php
 * Error reporting and types of errors are defined in php.ini.
 * By default, error_reporting reports all warnings, errors and notices
 * It is possible not to show e.g. deprecated or strict notices
 */
echo "<br><br>ERROR REPORTING, ERROR LOG AND DISPLAY ERRORS<br>";
//var_dump(ini_get(0)); // turn off error reporting
//var_dump(ini_get(E_ALL)); // report all errors
//var_dump(ini_get(E_ERROR)); // fatal runtime errors, stops the script execution
var_dump(ini_get('error_reporting'));
echo "<br>";
var_dump(E_ALL);

$array = [1];
echo $array[3]; // returns warning

var_dump(ini_set('error_reporting', E_ALL & ~E_WARNING)); // report everyting, except warnings
echo $array[3]; // does not return warning


echo "<br><br>THROW USER ERRORS";
// trigger_error('Example error', E_USER_ERROR); // stops the script execution
trigger_error('Example of a user thrown error: ', E_USER_WARNING); // does not stop the script execution
echo 1, "<br>";


/**
 * Some error types cannot be handled. For example, parse and compile errors. Such an example is forgotten ";"
 * at the end of line of code, and it will break the code execution.
 */
echo "<br>ERROR HANDLING<br>";
function errorHandler(int $type, string $msg, ?string $file = null, ?int $line = null){
    echo "Error type - $type: $msg in $file on $line";
    exit; // to stop the sript execution (return false also posible), otherwise use return true
}

set_error_handler('errorHandler', E_ALL); // E_ALL here will override the configured or previously set error configuration
echo $t;
// echo $tz // cannot be handled, breaks the code


echo "<br>DISPLAY ERRORS<br>";
var_dump(ini_get('display_errors')); // check error displaying default or set status

echo "<br>";
var_dump(ini_set('display_errors', 0));
echo $array[x]; // does not return error




