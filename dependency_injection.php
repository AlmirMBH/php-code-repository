<?php

class First{
    public $var1 = "First Class Value";
    public function getValue(){ return $this->var1;}
}

class Second{
    public $var2 = "";    
    // function __construct(First $class1){ $this->var2 = $class1->var1; }
     function __construct(First $class1){ $this->var2 = $class1->getValue(); }    
}

// $class1 = new First();
// $class2 = new Second($class1); // $class1 will be injected into the constructor of Second class
$class2 = new Second(new First()); // no e.g. inheritance required, just injection
echo $class2->var2;