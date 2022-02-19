<?php
print "<pre>";
//print_r($_ENV);
//print_r($_SERVER);
//print_r($_SERVER['PHP_SELF']); // Script file executing PHP code and path
// print $_SERVER['REQUEST_URI']; // Script file executing PHP code plus url query
//print $_SERVER['DOCUMENT_ROOT']; // Where the php docs are stored
// print $_SERVER['SERVER_ADDR']; // Server address
// print $_SERVER['REMOTE_ADDR'];   // User address; The same as server because of the local host
// print $_SERVER['HTTP_HOST'];       // Host name of the website
// print $_SERVER['HTTP_USER_AGENT']; // Accesing the user browser data
$time = $_SERVER['REQUEST_TIME']; // The exact time users access our website (string of numbers-timestamp-that needs to be converted into a time format)
print date('Y-m-d H:i:s a', $time);
print "<pre>";

//print getenv('APACHE_LOG_DIR'); 
?>