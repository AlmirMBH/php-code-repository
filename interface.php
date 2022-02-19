<!DOCTYPE html>
<html lang="en">
<head><title>Interfaces</title></head>
<body>

<h1>Interfaces</h1>

<?php

// Note: use interface when you need to impose method names or when you want
// to get access to all the classes that implement it (see line 49 below)

    interface PaymentOption{
        public function pay();
    }

    interface LoggedIn{
        public function loggedIn();
    }

    class Paypall implements PaymentOption, LoggedIn{
        public function pay(){ echo "You paid via paypall!"; }
        public function loggedIn(){ echo "You are logged in!"; }
        public function executePayment(){
            $this->loggedIn();
            $this->pay();
        }
    }

    class Stripe implements PaymentOption, LoggedIn{
        public function pay(){echo "You paid via stripe!"; }
        public function loggedIn(){ echo "You are logged in!"; }
        public function executePayment(){
            $this->loggedIn();
            $this->pay();
        }
    }

    class Cash implements PaymentOption{
        public function pay(){echo "You paid with cash!"; }
        public function executePayment(){
            $this->pay();
        }
    }

    // Interface implementation in the above classes makes it possible to use any of them as argument 
    // in this class; 
    class Purchase{
        public function executePurchase(PaymentOption $paymentOption){ $paymentOption->executePayment(); }
    }

    $paypall = new Paypall();   
    $stripe = new Stripe();     
    $cash = new Cash();     
    $purchase = new Purchase();

    $break = "<br>";
    $purchase->executePurchase($paypall);
    echo $break;
    $purchase->executePurchase($stripe);
    echo $break;
    $purchase->executePurchase($cash);


    // INTERFACE + INHERITANCE

    interface Animal {
        public function makeSound();
      }
      interface Movement{
          public function move();
      }
      abstract class Mamal{
          abstract function eat($food);
          public function legs($legs){ return $legs; }
      }
      class Domestic{    
          public function live($home){ return $home; }
      }
      
      

      class Cat extends Mamal implements Animal, Movement {
          public function makeSound() { return "meow"; }
          public function move() { return "Walk"; }
          public function eat($food = "milk") { return $food; }
      }
      
      class Dog extends Domestic implements Animal {
          public function live($home = " yard"){ return $home; }
          public function makeSound() { return "wow"; }
        }
      
      $cat = new Cat();
      $dog = new Dog();
      echo "<BR>A cat " . $cat->makeSound() . " and drinks " . $cat->eat() . "<br>";
      echo "A dog " . $dog->makeSound() . " and lives in a " . $dog->live();

?>


</body>
</html>