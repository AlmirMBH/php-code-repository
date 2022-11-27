<?php

declare(strict_types = 1);

require 'Transaction.php';

/**
 * Although strict mode is enabled, float type will accept integer.
 * 
 * Instead of multiple calls via the same object, the class methods can return instance of the object, which
 * enables us to chain them.
 */


echo "REGULAR SETTER CALLS<br>"; 
$transaction = new Transaction(100, 'Transaction 1');
$transaction->addTax(9);
$transaction->applyDiscount(2);
echo $transaction->getDescription() . ": " . $transaction->getAmount(), "<br>";


echo "<br>CHAINING METHODS<br>";
$transaction2 = new Transaction(25, 'Transaction 2');
$transaction2->addTax(9)->applyDiscount(2);
echo $transaction2->getDescription() . ": " . $transaction2->getAmount(), "<br>";


$amount = (new Transaction(55, 'Transaction 3'))
          ->addTax(4)
          ->applyDiscount(3)
          ->getAmount();
echo "<br>Transaction 3: ", $amount, "<br>";


echo "<br>STD CLASS<br>";
$newClass = new \stdClass();
$newClass->a = 'String 1';
$newClass->b = 'String 2';
var_dump($newClass);
echo "<br>";


echo "<br>CAST ARRAY TO CLASS<br>";
$arr2 = ['car' => 'peugeot', 'plane' => 'concord', 'truck' => 'scania'];
$arr3 = [1, 2, 3];
$obj1 = (object) $arr2;
$obj2 = (object) $arr3;
echo "Class casting: ", $obj1->{'car'}, "<br>"; // accessing object properties the same way array elements are accessed via indexes
echo "Class casting: ", $obj2->{1}, "<br>";


echo "<br>JSON TO ARRAY & CLASS<br>";
$str = '{"a":1, "b":2, "c":3}';
$arr = json_decode($str, true);
$stdClass = json_decode($str);

var_dump($arr);
echo "<br>";
var_dump($stdClass);
echo "<br>";


echo "<br>CAST INTEGER, BOOLEAN AND NULL TO CLASS<br>";
$intClass = (object) 1;
$boolClass = (object) true;
$nullClass = (object) null;
echo "Integer to class: ", $intClass->scalar, "<br>";
echo "Boollean to class: ", $boolClass->scalar, "<br>";
echo "Null to class: ", var_dump($nullClass), "<br>";