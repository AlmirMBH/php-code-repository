<?php

class Invoice{

    public ?Invoice $linkedInvoice = null;

    public function __construct(public Customer $customer, public float $amount, public string $description) { }

}


class CustomInvoice extends Invoice {

}


class Customer {

    public function __construct(public string $name) { }

}



$invoice1 = new Invoice(new Customer('Almir'), true, 'Invoice');
$invoice2 = new Invoice(new Customer('Almir'), 1, 'Invoice');
$invoice4 = new CustomInvoice(new Customer('Almir'), 1, 'Invoice');
$invoice5 = new CustomInvoice(new Customer('Almir M.'), 1, 'Invoice');
$invoice6 = new Invoice(new Customer('Almir MBH'), 1, 'Invoice');


/**
 * Identity vs comparison operator
 * Identity operator compares based on value, type and object memory location.
 * Comparison operator compares object property values based on loose comparison e.g. true == 1.
 */
echo 'invoice1 == invoice2<br>';
var_dump($invoice1 == $invoice2);

echo '<br><br>invoice1 == invoice2 (different number of object properties)<br>';
$invoice2->name = null;
var_dump($invoice1 == $invoice2);

echo '<br><br>invoice1 === invoice2<br>';
var_dump($invoice1 === $invoice2);


echo '<br><br>invoice1 === invoice3<br>';
/**
 *  $invoice3 is a copy of the pointer that points to the same memory location as $invoice1
 * In general, a variable is just a pointer that points to some value i.e. data structure. 
 * The container where the value is stored is called 'zeval' or zend value and it is a C language structure.
 * It stores the type of data and its value. Simple types are stored dirctly into the zend value containers but
 * objects are stored as object identifiers that are pointers to actual objects i.e. complex data structures, 
 * that is the object store that contains the actual object.
 * If a class has a property that is an instance of another class, a comparison is done in a recursive manner.
 * However, if there are 'circular' relations, the comparison will cause a fatal error.
 * 
 * Greater than and less than comparisons are possible with objects.
 */
$invoice3 = $invoice1;
echo 'loose<br>';
var_dump($invoice1 == $invoice3);
echo '<br>strict<br>';
var_dump($invoice1 === $invoice3);
$invoice3->amount = 250;
echo '<br>strict after changing the amount<br>';
var_dump($invoice1 === $invoice3); // true because both variables point to the same object


echo '<br><br>invoice1 == invoice4<br>';
echo 'loose<br>';
var_dump($invoice1 == $invoice4); // false, instances of different classes
echo '<br>strict<br>';
var_dump($invoice1 === $invoice4);


echo '<br><br>invoice1 == invoice5<br>';
echo 'loose<br>';
var_dump($invoice1 == $invoice5); // false, recursive comparison of the object property Customer (composition)
echo '<br>strict<br>';
var_dump($invoice1 === $invoice5);


echo '<br><br>Circular relation causing error due to recursive dependency<br>';
echo 'loose<br>';
$invoice1->linkedInvoice = $invoice6;
$invoice6->linkedInvoice = $invoice1;
var_dump($invoice1 == $invoice6); // false, recursive comparison of the object property Customer (composition)
echo '<br>strict<br>';
var_dump($invoice1 === $invoice5);
