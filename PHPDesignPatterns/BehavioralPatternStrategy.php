<?php
// BEHAVIORAL pattern deals with algorithms and assignment of responsiblities between objects. It is concerned with communication
// between objects. Used when the class has massive conditional operator for different variants of the same algorithm.
// STRATEGY is a subtype of behavioral pattern. It defines a family of algorithms, encapsulates each into a separate class and
// makes objects interchangeable. It is able to switch from one algorithm to another during the runtime.
 
// Strategy Interface
interface PaymentGateway{    
    public function pay($amount);
}

//Concrete Strategies
class PayByDcCC implements PaymentGateway{    
    public function pay($amount) {
        echo "Paid $amount via Debit/Credit Card<br>";
    }
}

class PayByPayPal implements PaymentGateway{    
    public function pay($amount) {
        echo "Paid $amount via PayPal<br>";
    }
}

// Context Class
class Order{    
    private $paymentGateway;
    
    public function setPaymentGateway(PaymentGateway $paymentGateway) {
        $this->paymentGateway = $paymentGateway;
    }

    public function pay($amount){
        $this->paymentGateway->pay($amount);
    }
}

// Client code
$order = new Order();
$order->setPaymentGateway(new PayByDcCC());
$order->pay(189);

// Client code
$order = new Order();
$order->setPaymentGateway(new PayByPayPal());
$order->pay(200);
















