<?php

declare(strict_types =  1);
/**
 * Covariance and Contravariance do not work with versions prior to php 7.4.
 * When a child class overrides a method from its parent class, a type of checking is required in order to make sure
 * that the overriding method is compatible with the method in the parent class.
 * For example, if a parent method accepts 'T' and returns 'T', the same method in the child class should accept and
 * return the compatible values. This exact compatibility requirement is called INVARIANCE.
 * 
 * Covariant return types
 * It is also possible that the overriding method can accept / return a more / less specific type.
 * PHP allows MORE specific types to be RETURNED by the overriding method which is called RETURN TYPE COVARIANCE.
 * For example, the return type of the method adopt in the AnimalShelter interface is Animal but the return types of adopt
 * methods in classes CatShelter and DogShelter are Cat and Dog. Contravariance is not allowed with return parameters.
 * 
 * Contravariant parameter types
 * In addition, PHP allows LESS specific types to be ACCEPTED by the overriding method which is called
 * PARAMETER TYPE CONTRAVARIANCE.
 * For example, the return type of the method eat in class Animal is AnimalFood but the return type of the eat methods in
 * classes Cat and Dog is Food.
 * 
 * Class constructors do not follow the above-mentioned rules. The constructor can be overriden and have different types.
 * 
 */
echo "INVARIANCE, COVARIANCE AND CONTRAVARIANCE<br>";

interface AnimalShelter {

    public function adopt(string $name): Animal;

}



abstract class Animal {

    public function __construct(protected string $name) { }

    abstract public function speak();

    public function eat(AnimalFood $food){
        var_dump('not called');
        echo $this->name . " eats " . get_class($food);
    }

}



class Food {

}



class AnimalFood extends Food {

}



class Cat extends Animal {

    public function speak(){
        echo $this->name . " meows<br>";
    }

    public function eat(Food $food){ // contravariance: AnimalFood -> Food (more general type)
        echo $this->name . " eats " . get_class($food), "<br>";
    }

}



class Dog extends Animal {

    public function speak(){
        echo $this->name . " barks<br>";
    }

    public function eat(Food $food){ // contravariance: AnimalFood -> Food (more general type)
        echo $this->name . " eats " . get_class($food), "<br>";
    }

}



class CatShelter implements AnimalShelter {

    public function adopt(string $name): Cat { // covariance: Animal -> Cat (more specific type)
        return new Cat($name);
    }

}



class DogShelter implements AnimalShelter {

    public function adopt(string $name): Dog { // covariance: Animal -> Cat (more specific type)
        return new Dog($name);
    }
    
}




$cat = (new CatShelter())->adopt("Ricky");
$catFood = new AnimalFood();
$cat->speak();
$cat->eat($catFood);

$dog = (new DogShelter())->adopt("Mavrick");
$dog->speak();
$dogFood = new Food();
$dog->eat($dogFood);



echo "<br><br>UNION AND INTERSECTION TYPES<br>";
/**
 * Union type accepts values of multiple different types. When using union types in base class, it is covariant, if the type 
 * or one of many types is removed in the overriding method of the child class. See classes A and B below.
 */
class A {

    public function run(): Dog|Cat { // union type
        return new Dog('Fido');
    }

}



class B extends A {

    public function run(): Cat {
        return new Cat('Fluffy');
    }

}


/**
 * Intersection type allows declaring a type for a parameter, property or return type and enforce that the value belongs
 * to all of the declared class / interface types.
 * When using intersection types in the base class, it is covariant when an additional type is added in the overriding
 * method of the child class. See classes C and D below.
 */
class C {

    public function run(): Dog { // intersection type
        return new Dog('Fido');
    }

}



class D extends C {

    public function run(): Dog&Cat {
        return new Cat('Fluffy');
    }

}



echo "<br><br>LISKOV SUBSTITUTION PRINCIPLE (LSP)<br>";
/**
 * An object and a sub-object or a class and a sub-class must be interchangeable without breaking the code.
 * In the example below, a dog can eat any type of food i.e. Food or AnimalFood and that exactly is the example of LSP.
 * In short, the Animal class accepts AnimalFood but the specific classes Dog and Cat override it and accept Food
 * (contravariance). In this way, it is possible to apply LSP and 'feed' the dog either AnimalFood or Food.
 */
$dog->eat($dogFood);
$dog->eat($catFood);