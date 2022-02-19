<?php
    session_start();

if(isset($_SESSION['id']) and isset($_SESSION['username']) and isset($_SESSION['status'])){
    echo "Welcome {$_SESSION['username']}, you are signed in as {$_SESSION['status']} <br><br>";
    echo "<a href='sessionlogout.php'> Session destroy / Log out </a>";
}else{
    //header('Location: sessionlogin.php');
    echo "You have to log in to see the content of this page! <br><br>";
    echo "<a href='sessionlogin.php'> Session create / Log in </a>";
}


?>