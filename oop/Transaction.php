<?php

declare(strict_types = 1);

/**
 * If class properties are not type hinted and then they are tried to be used (e.g. echo $transaction->amount) 
 * there will be no error i.e. their value is NULL. However, if they are type hinted the error will
 * appear - uninitialized.
 */
class Transaction{

    private float $amount;
    private string $description;

    // if no access modifier the method will still be public
    public function __construct(float $amount, string $description){
        $this->amount = $amount;
        $this->description = $description;
    }


    public function getAmount(){
        return $this->amount;
    }


    public function getDescription(){
        return $this->description;
    }


    public function addTax(float $rate): Transaction {
        $this->amount += $this->amount * $rate / 100; // adds percentage
        return $this;
    }


    public function applyDiscount(float $rate): Transaction {
        $this->amount -= $this->amount * $rate / 100; // subtracts percentage
        return $this;
    }



    /**
     * Although not always visible in the output, after the execution of the script the destruct is always called.
     */
    public function __destruct(){
        echo 'Destruct: ', $this->description, "<br>";
        // exit;
    }

}