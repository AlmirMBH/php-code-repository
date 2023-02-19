<?php

class Person{
    public $name;    
    public $surname;
    
    public function __getProperty(){
        return $this->property;
    }

    public function __setProperty($property, $value){
            return $this->property = $value;
    }

    
}
   
$person = new Person();
$person->name = "Almir";
echo $person->name;


/////////////////////////////

class User{
    private $name;
    private $age;
    
    public function __construct($name, $age){
        $this -> name = $name;
        $this -> age = $age;
    }
    public function getName(){
        echo $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    // __get Magic method
    public function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }   
       
    // __set Magic method
    public function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
        return $this;
    }
}
$user1 = new User("John", 40);
// Standard way by using a form, without magic method
//$user1 -> setName($_GET["name"]);
//echo $user1-> getName();


// Magic setters & getters
$user1->__set("age", 40);
$user1->__set("name", $_GET["name"]);
echo $user1->__get("name")." is ".$user1->__get("age");

    

?>