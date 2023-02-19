<?php

declare(strict_types = 1);

class Invoice{

    public function __destruct()
    {
        echo 'Invoice destructor' . PHP_EOL;
    }

}

/**
 * Invoice1 and invoice2 variables are created and their values are stored in the so-called symbol table,
 * separate from their values. Then, they point to some data structure in memory, which is called 'zeval' or
 * zend value. It has some information about the variable like its data type and value. 
 * The objects, however, are not stored directly, instead a sort of identifier / object id is stored, which
 * points to a place in memory where the actual object is stored. 
 * Therefore, when invoice2 is assigned invoice1, a new variable is created and it has its own container but it
 * has the copy of the same object identifier which points to the same object location in memory. In short,
 * invoice1 and invoice2 are 2 different variables but they point to the same object.
 * 
 * IMPORTANT
 * Based on the above-mentioned, if invoice1 is deleted (see below) the invoice2 should be deleted as well.
 * However, the invoice2 is not deleted, which means that php does not collect 'garbage'. This happens because
 * there is still a reference to the object. In general, php does garbage collecting when there are no
 * references to an object. This can cause memory leaks.
 * 
 * A weak reference is similar to a normal reference, except that it doesn't prevent the garbage collector
 * from collecting the object. 
 * In php 8, there is a weak map class and it allows us to have a collection of weak references that can
 * be garbage collected. In short, a weak map is just a key-value array store where keys are objects instead
 * of being numeric or string. For example, invoice1 is the key of an array ['a' => 1, 'b' => 2], see below.
 * SplObjectStorage has hard references.
 * 
 * Weak maps are most commonly not used directly. Usually, packages or frameworks use them 'behind the scenes'
 * for caching, memorization, memory leak prevention in long running processes, storing additional data that
 * is not available or that should not directly be available in the object, etc.
 * Only objects can be used in weak maps and new elements cannot be appended.
 */

$invoice1 = new Invoice();
$map = new WeakMap();
$map[$invoice1] = ['a' => 1, 'b' => 2];

echo "WEAK MAP<br>";
var_dump($map);

echo "<br><br>WEAK MAP INVOICE<br>";
var_dump($map[$invoice1]);

echo "<br><br>WEAK MAP COUNT<br>";
var_dump(count($map));
unset($invoice1);
echo "<br><br>WEAK MAP COUNT AFTER UNSETTING INVOICE 1<br>";
var_dump(count($map));



$invoice2 = $invoice1;

echo "<br><br>INVOICE 1 UNSET<br>";
unset($invoice1);

echo "<br>INVOICE 2 VAR DUMPED<br>";
var_dump($invoice2);

echo "<br><br>INVOICE 2 UNSET<br>";
unset($invoice2);

echo "<br><br>INVOICE 2 VAR DUMPED<br>";
var_dump($invoice2);