<?php

require_once 'stripe/Transaction.php';
require_once 'klarna/Transaction.php';
require_once 'klarna/CustomerProfile.php';

use Stripe\Transaction as StripeTransaction;
use Klarna\{Transaction, CustomerProfile}; // imports grouping
// use Klarna\CustomerProfile;
use function Klarna\pay;

/**
 * https://www.php.net/manual/en/language.namespaces.rules.php
 * Although PHP is looking for classes in the global space, if namespaces are not specified. However, if more
 * classes need to have the same name (e,g, requirement) they will cause an issue. For example, if you try to
 * create a Transaction object, a bug will appear as there are 2 Transaction classes (klarna and stripe).
 * 
 * require_once 'stripe/Transaction.php';
 * require_once 'klarna/Transaction.php';
 * 
 * The easiest and most common way to prevent this issue is by using namspaces.
 * 
 * While usually only classes are namespaced and used, it is also possible to namespace functions and constants
 * in the same way it is done with classes.
 */

echo "IMPORTS<br>";
var_dump(new Klarna\Transaction());
echo "<br>";
echo Stripe\pay(), "<br>";


echo "<br>NAMESPACES<br>";
var_dump(new Transaction());
echo "<br>";
echo pay();
echo "<br>";


echo "<br>NAMESPACES & ALIASES<br>";
$stripeTransaction = new StripeTransaction();
$klarnaTransaction = new Transaction();
$customerProfile = new CustomerProfile();

var_dump($customerProfile, "<br>", $stripeTransaction, "<br>", $klarnaTransaction);


/**
 * If a new file e.g. include('include/include-2.php'); is included in this place it will not have access to 
 * the above classes and methods.
 */