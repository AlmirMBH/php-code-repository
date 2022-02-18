<?php

    namespace Client;

    class Person{

        private $name;
        private $age;
        
        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }

        public function getPerson(){
            return $this->name . " is " . $this->age . " years old.";
        }
    }
   
?>
