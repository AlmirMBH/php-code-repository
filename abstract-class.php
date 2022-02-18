<!DOCTYPE html>
<html lang="en">
<head><title>Abstract classes</title></head>
<body>
    <h1>Abstract classes</h1>

<?php

// Note: Abstract classes are used when a class containing e.g. needed methods do not have to be instantiated;
// we do not need a class instance but only its methods. Abstract classes cannot be instantiated!
// If even one method is declared abstract, the entire class must be abstract and all the sub-classes must
// inherit the abstract method



    abstract class Visa{
        
        abstract public function executePayment();

        public function visaPayment(){        
            return $this->pay();
        }

        private function pay(){
            echo "Visa payment performed! ";
        }
    }


    class BuyProduct extends Visa{

        // The way in which the messages are printed in the browser 
        // shows the order of constructor, methods and destructor execution

        public function __construct(){
            echo "An instance created! ";    
        }

        public function __destruct(){
            echo "An instance destroyed! ";    
        }

        public function executePayment(){
            return $this->visaPayment();
        }
    }

    $buyProduct = new BuyProduct();
    $buyProduct->executePayment();



?>
    
</body>
</html>