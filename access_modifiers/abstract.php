<?php

abstract class Human{
    var $child1 = 6; 
    public $child2 = 8;
    protected $child3 = 10;
    private $child4 = 12;
    static $child5 = 14;
    public $test;

    abstract function age1($age);
    public function age2($age2){ return $age2; }
    protected function age3($age3){ return $age3; }
    private function age4($age4){ return $age4; } 
    static function age5($age5){ return $age5; } 
    
    public function checkAge($age){ if($age < 18){ return "Not enough"; } }
    public function childStatic(){ return self::$child5; }
    public function callOfStaticMethod($age){ return $this->test = self::age5($age); }
}

class Person extends Human{ 
    function age1($age, $overload = "hello"){ echo $age . $overload;}
    public function getAge3($age3){ return $this->age3($age3); }
    function getChild3(){ return $this->child3; }
    function getChild4(){ return $this->child4; }
}
// $human = new Human(); // invalid, abstract class cannot be instantiated
// $human->age();       // invalid, abstract class cannot be instantiated
$person = new Person();

echo "<br>EXTENSION OF METHODS OF ABSTRACT CLASSES<br>";
echo "STATIC CALLS<br>";
echo Human::age5(37 . "<br>") ; 
echo Person::age5(14 . "<br>"); 
echo $person::age5(22 . "<br>"); 

echo "<br>OBJECT CALLS<br>";
echo $person->age1(40, " overloaded<br>"); // abstract
echo $person->age2(45 . "<br>"); // public
// $person->age3(55);    //invalid, cannot access protected function from abstract class
echo $person->getAge3(50 . "<br>"); // protected via getter
echo $person->checkAge(2) . "<br>"; // full method from abstract class
echo $person->childStatic() . "<br>";
echo $person->callOfStaticMethod(22) . "<br>";

echo "<br>EXTENSION OF PROPERTIES OF PUBLIC CLASSES<br>";
echo "STATIC PROPERTIES<br>";
echo Human::$child5 . "<br>"; // static
echo Person::$child5 . "<br>"; // static
echo $person::$child5 . "<br>"; // static

echo "<br>OBJECT PROPERTIES<br>";
echo $person->child1 . "<br>"; // public (var)
echo $person->child2 . "<br>";          // public
// echo $person->child3 . "<br>"; // invalid, cannot access protected directly
echo $person->getChild3();          // protected via getter
// echo $person->child4;   // invalid, private property not visible, cannot be access directly
// $person->getChild4();    // invalid, private property not visible, cannot be access directly
