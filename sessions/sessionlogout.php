<?php
session_start();

session_unset();
session_destroy();

echo "You are logged out <br><br>";

echo "<a href='sessionlogin.php'> Session create / Log in </a>";
?>