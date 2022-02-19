<?php

if(isset($_COOKIE['id']) and isset($_COOKIE['username']) and isset($_COOKIE['status'])){
    echo "Dobrodosli {$_COOKIE['username']}, prijavljeni ste kao {$_COOKIE['status']}";
}else{
    echo "Morate biti prijavljeni da biste vidjeli stranicu";
}
echo "<br>";
echo "<a href='pagecolorsetup.php'> Go to page color setup </a>";
?>