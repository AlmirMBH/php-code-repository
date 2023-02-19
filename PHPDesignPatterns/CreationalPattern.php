<?php
// Factory method pattern (FMP) are used when we don't know what types of objects we need to create and work with
// FMP separates the object creation code from code which uses the product  
// The product interface declares the operations for all concrete products
interface Transport{
    
    public function ready() : void;
    
    public function dispatch() : void;
    
    public function delivery() : void;
}

// Concrete product providing implementations of Product interface
class PlaneTransport implements Transport{
public function ready(): void{ 
    echo "Courier ready to be sent to the plane"."<br>";
}

public function dispatch(): void{    
    echo "Courier is on the way to the plane"."<br>";
}

public function delivery(): void{    
    echo "Courier from the plane is delivered to you"."<br>";
}
}

// Concrete product providing implementations of Product interface
class TruckTransport implements Transport{
    
public function ready(): void{ 
    echo "Courier ready to be sent to the truck"."<br>";
}

public function dispatch(): void{    
    echo "Courier is on the way to the truck"."<br>";
}

public function delivery(): void{    
    echo "Courier from the truck is delivered to you"."<br>";
}

}

// The Creator class declares the factory method
abstract class Courier{    
    // Factory method                         returns the Transport interface
    abstract function getCourierTransport() : Transport;
    
    public function sendCourier(){
        $transport = $this-> getCourierTransport();
        $transport->ready();
        $transport->dispatch();
        $transport->delivery();
    }
}

// The Concrete Creator overrides the factory method and changes the type of object created
class AirCourier extends Courier{
    
    function getCourierTransport(): Transport {
        return new PlaneTransport();
    }
}

// The Concrete Creator overrides the factory method and changes the type of object created
class GroundCourier extends Courier{
    
    function getCourierTransport(): Transport {
        return new TruckTransport();
    }
}

// The client code works with an instance of concrete creator or subclass
function deliverCourier(Courier $courier){
    $courier->sendCourier();    
}

echo "Test Truck Courier"."<br>";
deliverCourier(new GroundCourier());

echo "<br>";

echo "Test Plane Courier"."<br>";
deliverCourier(new AirCourier());