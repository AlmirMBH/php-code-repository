<?php


// At compile time, code from traits is copied into the classes that use them; not polymorphism

const NLINE = "<br>";

trait Human{
    abstract function moves($movement);
    public static function greeting(){ return "Hi from HumanTrait!" . NLINE; }
    public function makeCoffee(){ echo static::class . " is making coffee" . NLINE; } // calls class that uses this method
    public function makeMeal(){ return "HumanTrait is cooking!" . NLINE; }
}

trait Person {
    use Human;
    public function message1() { echo "I am Bosnian." . NLINE; }
    protected function message2() { echo "I am Bosnian 1." . NLINE; }
    private function message3() { echo "I am Bosnian 2."  . NLINE; }
    static function message4() { echo "I am Bosnian 3."  . NLINE; }
    public function getProtectedAndPrivate(){ return $this->message2() . " " . $this->message3(); }
    public function makeMeal(){ return "PersonTrait is cooking!" . NLINE; }
}

class Bosnian {    
    // The app will break, if 2 methods with the same name in different traits are not distinguished
    use Person{ Person::makeMeal insteadOf Human; }
    use Human{ Human::makeMeal as cookingMeal; } // modifier can also be changed e.g. Human::makeMeal as public;
    private $name;

    public function fetchMessage(){ $this->message2(); }
    public function moves($movement = "Bosnian walks."){ return $movement . NLINE; }
    public function greeting(){ return "Greeting from HumanTrait has been overriden!" . NLINE; }
}


// TRAIT
echo Person::message4();
echo Person::greeting();
//$person = new Person(); // trait cannot be instantiated


// CLASS
$bosnian = new Bosnian();

echo $bosnian->message1();
echo $bosnian->fetchMessage();
echo Bosnian::message4();
echo $bosnian->moves();
echo $bosnian->getProtectedAndPrivate();
echo $bosnian->greeting();
echo $bosnian->makeCoffee();
echo $bosnian->makeMeal();
echo $bosnian->cookingMeal();
//echo $bosnian->message2(); // protected
//echo $bosnian->message3(); // private


?>