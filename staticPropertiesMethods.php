<!DOCTYPE html>
<html lang="en">
<head><title>Static properties and methods</title></head>
<body>
    <h1>Static properties and methods</h1>

<?php

    /**
     * When a property within a class does not have to be related with any
     * instance / object, it should be declared static.
     * 
     * Statics are generally not a good practice, however, if a singleton, counter or values shared between objects, 
     * as well as a sort of 'caching' between requests are required, then statics are a good option.
     */
    

    class Person{

        private $name;
        private $age;
        private $email;

        public static $drivingLicence = 18;

        public function __construct($name, $age, $email){
            $this->name = $name;
            $this->age = $age;
            $this->email = $email;
        }

        public static function setDrivingLicence($drivingL){
            self::$drivingLicence = $drivingL;
        }

        public static function getDrivingLicence(){
            return self::$drivingLicence;
        }
    }

    Person::setDrivingLicence(22);
    echo Person::$drivingLicence, "<br>";
    echo Person::getDrivingLicence(), "<br>";



    class Transaction{

        public static int $count = 1;

        public function __construct(public float $amount, public string $description){
            echo "Object number ", self::$count++, " created<br>";
        }

        public function process(){
            echo "Processing transaction";
        }
    }


    $transaction1 = new Transaction(23, 'Transaction 1');
    $transaction2 = new Transaction(25, 'Transaction 2');
    $transaction2 = new Transaction(27, 'Transaction 3');
    var_dump(Transaction::$count);
    echo "<br>";
?>

</body>
</html>