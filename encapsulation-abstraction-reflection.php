<?php declare(strict_types=1) ?>

<!DOCTYPE html>
<html lang="en">
<head><title>Encapsulation & abstraction</title>
</head>
<body>
    <h1>Encapsulation & abstraction</h1>

    <?php
        //General notes
        // Most important concepts of OOP: encapsulation, polymorphism, 
        // abstraction and inheritance

        // Encapsulation hides the internal state or the information, while the abstraction hides the implementation
        // Abstraction means that internal implementation of an object is hidden from users, they use e.g. method 
        // process() to process payment below but they do not know how it works and what additional things
        // it does...send email etc., 
        
        // getters and setters are sometimes considered a bad practice as they might violate encapsulation
        // principle; e.g. when object shuold be constructed and values assigned only once
        // in case of transactions (e.g. if corrections are needed), it might be better to create another 
        // transaction then change the state of the existing transaction object 
        // never create setters and getters just because there is a class property
    
        class Transaction{

            private float $amount; // public modifier would violate encapsulation and abstraction principles
            const BREAK = "<br>";

            public function __construct(float $amount){
                $this->amount = $amount;
            }

            // objects of the same type can access each others private/protected properties and methods
            public function copyFrom(Transaction $transaction){
                var_dump($transaction->amount, $transaction->sendEmail());
            }

            public function setAmount(float $amount) {
                $this->amount = $amount;
            }            

            public function getAmount() : float {
                return $this->amount;
            }

            public function process(){
                echo "Processing $" . $this->amount . " transaction." . self::BREAK;

                $this->generateReceipt();

                $this->sendEmail();
            }


            private function generateReceipt(){ echo "Generating receipt!" . self::BREAK; }

            private function sendEmail(){ echo "Sending email!" . self::BREAK;}
        }

        
            $transaction = new Transaction(25);  
            echo $transaction->getAmount();          
            echo "<br>";    

            // PHP reflection API, which provides the ability to introspect classes
            $reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($transaction, 125);
            var_dump($reflectionProperty->getValue($transaction));

            echo "<br>";            
            $transaction->process();

            echo "<br>";
            $transaction->copyFrom(new Transaction(24));
        
    ?>
    
</body>
</html>