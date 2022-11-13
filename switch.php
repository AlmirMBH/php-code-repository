<?php

echo "SWITCH<br>";
$paymentStatuses = [1, 3, 0];

foreach($paymentStatuses as $paymentStatus){
    switch($paymentStatus){
        case 1:
            echo "Paid";
            // if both loops not broken, the outer loop will go through all the payment statuses; 
            // other cases will be included
            break 2;
            //  "continue" targeting switch is equivalent to "break"; use continue 2
            // continue 2; 
        case 2:
        case 3:
            echo "Payment declined";
            break 2;
        case 0:
            echo "Panding payment";
            break;
        default:
            echo "Unknown payment status";
    }
}


echo "<br><br>SWITCH vs IF<br>IF STATEMENT WITH FUNCTION CALL OUTSIDE THE LOOP<br>";
// If we have functions that take time to execute and we use IF, we might get into an issue
// The x() method is called every time the condition is evaluated
// A simulation of such a case is provided in IF and swich statements below

$x = x();
if($x === 1){ // 3 seconds to execute
    echo 1;
}
elseif($x === 2){ // 6 seconds to execute
    echo 2;
}
elseif($x === 3){ // 9 seconds to execute
    echo 3;
}
else{
    echo 4;
}


echo "<br><br>IF STATEMENT WITH FUNCTION CALL INSIDE THE LOOP<br>";
if(y() === 1){ // 3 seconds to execute
    echo 1;
}
elseif(y() === 2){ // 6 seconds to execute
    echo 2;
}
elseif(y() === 3){ // 9 seconds to execute
    echo 3;
}
else{
    echo 4;
}


echo "<br>SWITCH<br>";
// no matter which case, the x() method is called only once and it takes 3 seconds to execute
switch(z()){ 
    case 1:
        echo 1;
        break;
    case 2:
        echo 2;
        break;
    case 3:
        echo 3;
        break;
    default:
        echo 4;
}


// Functions with the execution delay
function x() {
    static $counter = 1;
    sleep(1);
    echo "Executing $counter time(s)<br>";
    $counter++;
    return 3;
}

function y() {
    static $counter = 1;
    sleep(1);
    echo "Executing $counter time<br>";
    $counter++;
    return 3;
}

function z() {
    static $counter = 1;
    sleep(1);
    echo "Executing $counter time<br>";
    $counter++;
    return 3;
}