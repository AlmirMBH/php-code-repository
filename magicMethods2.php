<!DOCTYPE html>
<html lang="en">
<head><title>Magic methods 2</title></head>
<body>

    <h1>Magic methods 2</h1>

    <!-- Magic methods require objects; they are not meant to replace standard getters and setters -->
    <?php

        class Invoice{

            protected array $data = [];
                        
            public function __get(string $name){
                
                if(array_key_exists($name, $this->data)){
                    return $this->data[$name];
                }
                return null;
            }

            public function __set(string $name, $value) :void{                
                    $this->data[$name] = $value;                
            }

        }

        $invoice = new Invoice(15);
        $invoice->amount = 35;
        echo $invoice->amount;
        echo "<br>";



        class Bill{

            // Method call() requires objects; 
            // it returns the name of the called method and its arguments (type and value)
            // call_user_func_array() can be used instead of standard object method call i.e. $this->$name($arguments),
            // however, this function allows us to pass array as argument, although float is required and the same implementation
            // can be used with callStatic()
            
                                                
            public function __call(string $name, array $arguments){

                if(method_exists($this, $name)){
                    // $this->$name($arguments);
                    call_user_func_array([$this, $name], $arguments);                    
                }                
            }

            protected function process(float $amount, $description){
                var_dump($amount, $description);
            }

            

            public function __callStatic($name, $arguments){                
                var_dump($name, $arguments);
            }
        }

        $bill = new Bill();
        $bill->process(15, 'Method description');
        echo "<br>";
        $bill::processStatic([1, 2 => 'car', 3]);
        echo "<br>";


        class Receipt{

            public function __toString() : string{
                return 1;
            }

        }

        // since php 8 Stringable interface; prior to php 8 Stringable had to be implemented in the class
        $receipt = new Receipt();        
        var_dump($receipt instanceof Stringable); 
        

        // Method invoke() is called when an object is called directly; useful for single-action (SRP) classes
        class Pay{

            public function __invoke(){
                var_dump('Invoke');
            }

        }
        echo "<br>";
        $pay = new Pay();
        $pay();
        echo "<br>";
        var_dump(is_callable($pay));


        
        // if a class object is var dumped, the dumped message will show info about the class including its
        // (private and protected) fields; to prevent this from happening, debugInfo is used
        class Debug{
            private float $amount = 23.55;
            private int $id = 1;
            private string $accountNumber = '5544332333';
            public function __debugInfo() :?array{ // no or an array
                return [
                    'id' => $this->id,
                    'account number' => '****' . substr($this->accountNumber, -4)
                ];
            }
        }

        echo "<br>";
        $debug = new Debug();
        var_dump($debug);
        
    ?>
    
</body>
</html>