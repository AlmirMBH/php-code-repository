<?php

$paymentStatus = 4;

// unlike switch (loose comparison), match performs strict comparison 
$paymentStatusDisplay = match($paymentStatus){ 
    0 => "Pending payment<br>",
    1 => "Paid<br>", // print "Paid"; will return 1
    2, 3 => "Payment declined<br>",
    4 => getNumber(),
    
    default => 'Unknown payment status'
};

function getNumber(){
    return "User cancelled the payment";
}

echo $paymentStatusDisplay;

