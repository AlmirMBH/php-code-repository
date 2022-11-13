<?php

/**
 * When defining functions within a function, the outer function must be called first
 * Otherwise, the inner functions will not be declared and an error will be thrown
 */

foo();
bar(); 

function foo(){
    echo "Foo<br>";

    function bar(){
        echo "Bar<br>";
    }
}


// no error will be thrown if string returned because strict_type is not declared
function getNum(): int {
    return '1';
}
echo getNum();
echo  '<br>';

// '?' allows passing the declared type or null
function getName(): ?string {
    return null;
}
echo getName();
echo  '<br>';


function getData(): mixed {
    $date = date('Y-m-d');
        if($date > '2022-11-13'){
            $res = 1;            
        }elseif ($date < '2022-11-13'){
            $res = 1.5;
        }else{
            $res = [2];
        }
    return $res;
}
echo getData();
echo  '<br>';
