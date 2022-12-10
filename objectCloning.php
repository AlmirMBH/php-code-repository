<!DOCTYPE html>
<html lang="en">
<head><title>Object cloning</title></head>
<body>
    
<h1>Object cloning & Clone magic method</h1>

    <?php

        // cloning is 'shallow copying'; not like with (un)serialize
        const NLINE = '<br>';

        class Invoice{
            private string $id;

            public function __construct(){ 
                $this->id = uniqid('invoice_'); // attaches random id at the end of 'invoice_'
                var_dump("CONSTRUCT"); 
                echo NLINE;
            }

            public function __clone(){ 
                $this->id = uniqid('invoice_'); 
                var_dump("CLONE"); 
                echo NLINE;
            }

            public static function create(){ 
                var_dump("CREATE"); 
                echo NLINE;
                return new static(); 
            }
        }
        
        var_dump(Invoice::create()); // calls create and constructor
        echo NLINE;

        // $invoice2 = $invoice; //this would just create 2 pointers to the same memory location
        $invoice = new Invoice();
        $invoice2 = clone $invoice; // clone does not call the constructor; __clone() gets called
        
        echo "CLONED OBJECT WITH THE SAME ID AND DIFFERENT MEMORY LOCATIONS: <br>";
        var_dump($invoice);
        echo NLINE;
        var_dump($invoice2);


    ?>
</body>
</html>