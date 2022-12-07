<?php

class Chef{
    
    function makeChicken(){
        echo "The chef makes chicken <br>";
    }
    
    function makeSalad(){
        echo "The chef makes salad <br>";
    }
    
    function makeSpecialDish(){
        echo "The chef makes bbq ribs <br>";
    }
}

// INHERITANCE
 class ItalianChef extends Chef{
     function makePasta(){
        echo "The chef makes pasta <br>";
    }
    
    function makeSpecialDish(){
        echo "The chef makes chicken parm <br>";
    }
 }


echo "INHERITANCE I<br>";
$chef = new Chef();
$chef ->makeSpecialDish();

$italianChef = new ItalianChef();
$italianChef ->makeSpecialDish();


echo "<br>INHERITANCE II<br>";
class Toaster{
    public array $slices;
    protected int $size;

    public function __construct(){
        $this->slices = [];
        $this->size = 2;
    }


    public function addSlice(string $slice): void {
        // var_dump($this);
        if(count($this->slices) < $this->size){
            $this->slices[] = $slice;
        }
    }


    public function toast(){
        foreach($this->slices as $i => $slice){
            echo ($i+1) . ': Toasting ' . $slice . "<br>";
        }
    }


    public function foo(){
        // method specific only for this / parent class
    }


}



class ToasterPro extends Toaster{
    
    /**
     * Inheritance creates a tight coupling between patrent and child classes.
     * Visibiliti of a property or a method can be 'increased' in the child class but not decreased i.e.
     * protected can become public but not vice-versa
     * If a constructor is present in both parent and child classes, by default the parent constructor will
     * not be called.
     * The same applies to any other method i.e. if it is overriden in the child class the method will not
     * be called from the parent class.
     * If any value is overriden from the parent class it needs to be specified in the child class constructor
     * after the parent constructor call, otherwise the property is taken from the parent constructor.
     * Overriden methods in the child classes must have the same signature as those in the parent. However,
     * this rule does not apply to constructors.
     * The downside of the inheritance is the violation of encapsulation i.e. anything can be accessed in 
     * child classes and modified. Also, by inheriting a class, everything is inherited from the parent class,
     * although it might not be needed in the child class.
     */

    public function __construct(){
        // $this->slices = [];
        parent::__construct();
        $this->size = 4;
    }


    /**
     * A method can be overriden or a method from parent can be called within the overriden method.
     */
    public function addSlice(string $slice): void{
        parent::addSlice($slice);
    }


    public function toastBagel(){
        foreach($this->slices as $i => $slice){
            echo ($i+1) . ': Toasting ' . $slice . ' with bagel option' . "<br>";
        }
    }


    /**
     * This is often seen in projects and it is not a good design. Consider composition instead.
     */
    public function foo(){
        throw new \Exception('Not supported');
    }
}

echo "<br>Toaster<br>";
$toaster = new Toaster();
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->toast();


echo "<br>Toaster Pro<br>";
$toasterPro = new ToasterPro();
$toasterPro->addSlice('bread');
$toasterPro->addSlice('bread');
$toasterPro->addSlice('bread');
$toasterPro->addSlice('bread');
$toasterPro->toast();
echo "<br>";
$toasterPro->toastBagel();


echo "<br>Child class object as an argument<br>";
foo($toasterPro);
echo "<br>Parent class object as an argument<br>";
foo2($toasterPro);


/**
 * Typehint parent, not a child class, see 'foo2'
 * If parent does not have the same methods as child, use composition instead of 'instanceOf' to prevent
 * errors that might appear due to calling child methods via parent class object.
 */
function foo(ToasterPro $toasterPro){
    return $toasterPro->toast();
}


function foo2(Toaster $toasterPro){
    return $toasterPro->toast();
}



/**
 * Do not extend Toaster class if there is e.g. an oven that also has a toaster on it.
 * In such cases use composition like in FancyOven class.
 */
class FancyOven{

    public function __construct(private ToasterPro $toasterPro){ }

    public function fry(){

    }



    public function toast(){
        $this->toasterPro->toast();
    }


    public function toastBagel(){
        $this->toasterPro->toastBagel();
    }
}


echo "<br>COMPOSITION<br>";
$fancyOven = new FancyOven($toasterPro);
$fancyOven->toast('bread');




?> 