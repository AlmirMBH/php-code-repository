<?php declare(strict_types=1) ?>

<!DOCTYPE html>
<html lang="en">
<head><title>Encapsulation & abstraction</title>
</head>
<body>
    <h1>Encapsulation & abstraction</h1>

    <?php
    /**
     * General notes
     * Most important concepts of OOP: encapsulation, polymorphism, abstraction and inheritance
     * Encapsulation hides the internal state or the information, while the abstraction hides the implementation.
     * Abstraction means that internal implementation of an object is hidden from users, they use e.g. method 
     * process() to process payment but they do not know how it works and what additional things it 
     * does...send email etc. 
        
     * getters and setters are sometimes considered a bad practice as they might violate encapsulation principle. 
     * For example, when object shuold be constructed and values assigned only once in case of 
     * transactions (e.g. if corrections are needed), it might be better to create another transaction then 
     * change the state of the existing transaction object; never create setters and getters just because there
     * is a class property
     */
        

        class Transaction{

            const BREAK = "<br>";
            /**
             * properties with 'public; modifier violate encapsulation and abstraction principles because
             * anybody communicating with the object can cjange the value of its properties.
             */        
            private float $amount; 


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


            /**
             * It is always a good idea to 'hide' methods that are not meant to be publicly available within 
             * other methods that need to be exposed.
             * For example, sending an email and generating a receipt could be executed within the process method.
             */
            public function process(): void{               
                echo "Processing $" . $this->amount . " transaction." . self::BREAK;
                $this->generateReceipt();
                $this->sendEmail();
            }


            private function generateReceipt(): void{ 
                echo "Generating a receipt!" . self::BREAK; 
            }


            private function sendEmail(): void{ 
                echo "Sending an email!" . self::BREAK;
            }

        }

        
            echo "SETTERS AND GETTERS";
            $transaction = new Transaction(25);  
            echo "<br>Amount set via constructor: ", $transaction->getAmount();          
            echo "<br>";    
            $transaction->setAmount(33); 
            // $transaction->amount = 55; 
            echo "Amount set via setter: ", $transaction->getAmount(); 
            echo "<br>";

            echo "<br>PROCESS METHOD<br>";
            $transaction->process();
            echo "<br>";


            echo "<br>PHP REFLECTION CLASS (ability to introspect classes)<br>";
            $reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($transaction, 125);
            echo "Amount set via reflection class: ", var_dump($reflectionProperty->getValue($transaction)), "<br>";

           

            echo "<br>COPYING OBJECTS<br>";
            /**
             * In this way, it is possible to access private and protected properties and methods
             */
            $transaction->copyFrom(new Transaction(26));
        
    ?>
    
</body>
</html>