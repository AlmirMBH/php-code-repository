<?php

setcookie('id', '1', time()-1, '/');
setcookie('username', '', time()-1, '/');            
setcookie('status', '', time()-1, '/');

echo "You are logged out";
echo "<br>";
echo "<a href='cookielogin.php'> Go to login page </a>";
?>