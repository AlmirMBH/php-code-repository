<?php
    declare(strict_types=1); // enables strict types feature
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Type declaration</title></head>
<body>
    
    <h1>Type declaration</h1>

<?php

    class Person{
        private $name;

        public function setName(string $name){
            $this->name = $name;
        }

        public function getName(){
            return $this->name;
        }
    }

    $person = new Person();

    try{
        $person->setName(2);
        echo $person->getName();
    }catch(TypeError $e){
        echo "Error!: " . $e->getMessage();
    }

?>

</body>
</html>