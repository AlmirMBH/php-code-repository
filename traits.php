<?php

trait Human{
    abstract function moves($movement);    
}

trait Person {
    public function message1() { echo "I am Bosnian.<br>"; }
    protected function message2() { echo "I am Bosnian 1.<br>"; }
    private function message3() { echo "I am Bosnian 2.<br>"; }
    static function message4() { echo "I am Bosnian 3.<br>"; }
}

class Bosnian {
    use Human;
    use Person;

    public function fetchMessage(){ $this->message2(); }
    public function moves($movement = "Bosnian walks"){ return $movement; }
}

// TRAIT
echo Person::message4();
// $national = new Person(); // trait cannot be instantiated

// CLASS
$bosnian = new Bosnian();
echo $bosnian->message1();
//echo $bosnian->message2(); // protected
echo $bosnian->fetchMessage();
//echo $bosnian->message3(); // private
echo Bosnian::message4();
echo $bosnian->moves();

?>