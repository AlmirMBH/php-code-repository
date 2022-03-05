<?php


// At compile time, code from traits is copied into the classes that use them; not polymorphism
// Although traits have many options, it's recommendable to use traits for simple code re-use e.g. use
// interfaces for contracts or abstract classes for abstract methods
// final methods in traits can still be overriden

const NLINE = "<br>";

trait Human{
    protected $food = "mashrooms"; // property cannot be redefined in the underlying traits or classes
    public static $activity = "running";

    abstract function moves($movement);
    public static function greeting(){ return "Hi from HumanTrait!" . NLINE; }
    // public function makeCoffee(){ echo static::class . " is making coffee" . NLINE; } // calls class that uses this method
    public function makeCoffee(){ echo __CLASS__ . " is making coffee" . NLINE; } // calls class that uses this method
    public function makeMeal(){ return "HumanTrait is cooking!" . NLINE; }
    abstract public function getFood(); // trait does not have to abstract because of this abstract method
}

trait Person {
    use Human;

    protected $food = "mashrooms";
    
    public function message1() { echo "I am Bosnian." . NLINE; }
    protected function message2() { echo "I am Bosnian 1." . NLINE; }
    private function message3() { echo "I am Bosnian 2."  . NLINE; }
    static function message4() { echo "I am Bosnian 3."  . NLINE; }
    public function getProtectedAndPrivate(){ return $this->message2() . " " . $this->message3(); }
    public function makeMeal(){ return "PersonTrait is cooking " . $this->food . "." . NLINE; }
    public function setFood(string $food){ $this->food = $food; }
}

class Bosnian {    
    // The app will break, if 2 methods with the same name in different traits are not distinguished
    use Person{ Person::makeMeal insteadOf Human; }
    use Human{ Human::makeMeal as cookingMeal; } // modifier can also be changed e.g. Human::makeMeal as public (weird);
    private $name;

    public function fetchMessage(){ $this->message2(); }
    public function moves($movement = "Bosnian walks."){ return $movement . NLINE; }
    public function greeting(){ return "Greeting from HumanTrait has been overriden!" . NLINE; }
    public function getFood(){
        return $this->food . NLINE;
    }
}


// TRAIT
echo Human::$activity . NLINE;
echo Person::$activity . NLINE;
echo Person::message4();
echo Person::greeting();
//$person = new Person(); // trait cannot be instantiated


// CLASS
$bosnian = new Bosnian();

echo $bosnian->setFood('meat');
echo $bosnian->message1();
echo $bosnian->fetchMessage();
echo Bosnian::message4();
echo $bosnian->moves();
echo $bosnian->getProtectedAndPrivate();
echo $bosnian->greeting();
echo $bosnian->makeCoffee();
echo $bosnian->makeMeal();
echo $bosnian->cookingMeal();
echo $bosnian->getFood();
//echo $bosnian->message2(); // protected
//echo $bosnian->message3(); // private


?>