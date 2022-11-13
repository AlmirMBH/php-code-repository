<?php

/**
 * require
 * require_once - requires a file only if it has not already been included
 * include
 * include_once - includes a file only if it has not already been included
 * In case of errors, include results in a warning, while require throws an error 
 * and stops the execution of the script 
 */

include 'include-2.php';
$x++;
echo $x, "<br>"; // 6

include 'include-2.php';
echo $x, "<br>"; // 5

include_once 'include-2.php';
echo $x, "<br>"; // 5

$y = include 'include-3.php';
var_dump($y);
echo "<br>";

ob_start(); // remove html from included file
include 'include-4.php';
$nav = ob_get_clean();
print_r($a);
echo $nav;
$nav = str_replace('About', 'About Us', $nav);
echo $nav;