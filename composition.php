<?
    declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head><title>Composition</title></head>
<body>
    <h1>Composition</h1>


<?php
    
    class First{        
        public $greeting1 = "Hello!";
        
        public function getGreeting(){ 
            return $this->greeting1;
        }
    }


    class Second{        
        public First $firstClass;
        
        public function __construct(First $firstClass){ 
            return $this->firstClass = $firstClass; 
        }    
    }

    $class2 = new Second(new First());
    echo $class2->firstClass->getGreeting();

?>

    
</body>
</html>