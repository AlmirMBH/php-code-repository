<?php

class Chef{
    
    function makeChicken(){
        echo "The chef makes chicken <br>";
    }
    
    function makeSalad(){
        echo "The chef makes salad <br>";
    }
    
    function makeSpecialDish(){
        echo "The chef makes bbq ribs <br>";
    }
}

// INHERITANCE
 class ItalianChef extends Chef{
     function makePasta(){
        echo "The chef makes pasta <br>";
    }
    
    function makeSpecialDish(){
        echo "The chef makes chicken parm <br>";
    }
 }


$chef = new Chef();
$chef ->makeSpecialDish();

$italianChef = new ItalianChef();
$italianChef ->makeSpecialDish();

?> 