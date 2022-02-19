<?php

// DECORATOR adds new behaviors dynamically to the existing objects by placing them inside special wrapper objects that 
// contain the behaviors, but it does not change the code. It's like a putting your gift into decorating paper and then 
// into a bag. The gift does not change its properties. It is used when inheritance is not possible or difficult.

// Base component
interface Pizza{    
    public function getDesc() : String;    
}

// Concrete components
class Margherita implements Pizza{
    public function getDesc() : String{
        return "Margherita";
    }
}

class VeggieParadise implements Pizza{
    public function getDesc() : String{
        return "Veggie Paradise";
    }
}

// Base Decorator
class PizzaTopings implements Pizza{
    
    protected $pizza;
    
    function __construct(Pizza $pizza) {
        $this->pizza = $pizza;
    }
    
    public function getDesc(): String {
       return $this->pizza->getDesc();
    }
}

// Concrete Decorators
class ExtraCheese extends PizzaTopings{
    public function getDesc() : String{
        return parent::getDesc()."Extra Cheese";
    }    
}

class Jalapeno extends PizzaTopings{
    public function getDesc() : String{
        return parent::getDesc()."Jalapeno";
    }    
}

function makePizza(Pizza $pizza){
    echo "Your Order: ".$pizza->getDesc();
}

$pizza = new Margherita();
$pizza = new ExtraCheese($pizza);
$pizza = new Jalapeno($pizza);

makePizza($pizza);
        