<?php

class Human1{   
    var $child1 = 6; 
    public $child2 = 8;
    protected $child3 = 10;
    private $child4 = 12;
    static $child5 = 14;
    
    public function age1($age1){ return $age1; }
    protected function age2($age2){ return $age2; }    
    private function age3($age2){ return $age2; }  // not possible for private method  
    static function age4($age4){ return $age4; }
    final function age5($age3){ return $age3; }    
}

class Person1 extends Human1{ 
    public function protectedMethod($age2){ return $this->age2($age2); }
    public function age1($age1){ return $age1 . " overriden!"; }
    public function getAge2($age2){ return $this->age2($age2); }
    public function getAge3($age3){ return $this->age3($age3); }
    public function getChild3(){ return $this->child3;} 
    public function getChild4(){ return $this->child4;} // not possible for private property        
    public function protectedProperty(){ return $this->child3; }  
}
$person1 = new Person1();

echo "<br>EXTENSION OF METHODS OF PUBLIC CLASSES<br>";
echo $person1->age1(25, 35) . "<br>"; // public
//$person1->age2(60); // invalid, cannot access protected directly
echo $person1->getAge2(30) . "<br>"; // protected via getter
echo $person1->protectedMethod(33) . "<br>"; // protected via public function in child
//$person1->age3(65); // invalid, cannot invoke private method
// $person1->getAge3(35); // invalid, cannot invoke private method
echo $person1->age5(6) . "<br>";
echo Person1::age4(40); // static

echo "<br>EXTENSION OF PROPERTIES OF PUBLIC CLASSES<br>";
echo "<br>" . $person1->child1 . "<br>"; // public (var)
echo $person1->child2 . "<br>";         // public
//echo $person1->child3 . "<br>"; // invalid, cannot access protected property
echo $person1->getChild3() . "<br>"; // protected via getter
echo $person1->protectedProperty() . "<br>"; // protected via public function in child
// echo $person1->child4 . "<br>"; // invalid, cannot access private directly
// $person1->getChild4();           // invalid, cannot access private directly