<!DOCTYPE html>
<html lang="en">
<head><title>Constructor and destructor</title></head>
<body>
    
<?php
    class Person{

        private $name;
        
        // The way in which the messages are printed in the browser 
        // shows the order of constructor, methods and destructor execution

        public function __construct(){
            echo "An instance created! ";    
        }

        public function __destruct(){
            echo "An instance destroyed! ";    
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            return $this->name = $name;
        }
    }

    $person = new Person();
    $person->setName("Almir");

    // delete object
    unset($person);
    echo $person->getName();


?>

</body>
</html>