<?php

declare(strict_types = 1);

require_once 'Customer.php';
require_once 'PaymentProfile.php';

/**
 * If class properties are not type hinted and then they are tried to be used (e.g. echo $transaction->amount) 
 * there will be no error i.e. their value is NULL. However, if they are type hinted the error will
 * appear - uninitialized.
 * 
 * Constructor property promotion was introduced in php8. It shortens the constructor syntax i.e. the 
 * constructor still recognizes that there are class properties that are passed to it and it will immediately
 * assigned the passed values to them.
 * A combination of the old and new way of stating class properties is allowed.
 * Only a simple expressions and values can be assigned as default values i.e. no function calls or complex
 * expressions can be assigned in the constructor.
 * 
 * Callable e.g. private callable $function is not allowed as class property but allowed as argument since
 * php 8 but it cannot have access modifiers.
 */

class Transaction{

    private float $amount;
    // public ?Customer $customer = null;
    private ?Customer $customer = null;

    public function __construct(
        float $amount,
        private ?string $description = 'Hello', 
        callable $callableFunction = null
    ) { 
        $this->amount = $amount;
    }


    public function getCustomer(): ?Customer {
        return $this->customer;
    }

}


/**
 * Null coalescing operator does not work with methods but null safe operator can help.
 * Null safe operator prevents errors.
*/
$transaction = new Transaction(5, 'Hello world!'); 
echo $transaction->getCustomer()?->getPaymentProfile()?->id ?? 'foo';
//$transaction->getCustomer()?->setPaymentProfile(createProfile()); // setting properties is also possible