<?php
/**
 * It is possible to enable strict mode on a per-file basis. In strict mode, only a variable of exact type of 
 * the type declaration will be accepted, or a TypeError will be thrown. The only exception to this rule is 
 * that an integer may be given to a function expecting a float. Function calls from within internal functions 
 * will not be affected by the strict_types declaration.
 */
declare(strict_types=1);?>
<!DOCTYPE html>
<head><title>Iterators</title></head>
<body>
    <h1>Iterators</h1>

    <?php

        // For the sake of simplicity, a simple example is provided; iteratoir would normally be used with more complex code
        // see PHP Traversable interface (empty base interface that lets classes be traversable using foreac loop) 
        // that is implemented by IteratorAggregate and Iterator
        // implementation of Iterator interface improves the performance and enables the use of
        // specific iteration over arrays/objects; defines how objects should be iterated over
        // PHP provides a number of iterators

        class Invoice{
            public int $id; 
            public int $amount;           
            public function __construct($amount){
                $this->id = random_int(10000, 9999999);
                $this->amount = $amount;
            }            
        }


        // Iterator interface
        class InvoiceCollection implements Iterator{

            private int $key;

            public array $invoices;
            public function __construct(array $invoices){
                $this->invoices = $invoices;
            }
            
           // Iterator methods
           // returns the current element from the invoice list
            public function current(){
                echo __METHOD__ . " -> element exists " . PHP_EOL;
                return current($this->invoices);
                // return $this->invoices[$this->key];
            }

            // brings the internal pointer to the next element
            public function next(): void {
                echo __METHOD__ . " -> pointer points to the next element " . PHP_EOL;
                next($this->invoices);
                // ++$this->key;
            }

            // returns the key of the current element
            public function key(): mixed {
                echo __METHOD__ . " -> key of the current element " . PHP_EOL;
                return key($this->invoices);
                // return $this->key;
            }

            // checks if the current position is valid; if false, the foreach stops
            public function valid(): bool {
                $nextElement = current($this->invoices) ? 'true' : 'false';
                echo __METHOD__ . " -> checks if the next position is valid and, if it is, calls next element - " . $nextElement . PHP_EOL;
                return current($this->invoices) !== false;
                // return isset($this->invoices[$this->key]);
            }

            // gets called at the beginning of the foreach loop; resets the array pointer back to the beginning
            public function rewind(): void {
                echo __METHOD__ . " -> pointer points to the beginning " . PHP_EOL;
                reset($this->invoices);
                // $this->key = 0;
            }            
        }
        // output
        $invoiceCollection = new InvoiceCollection([new Invoice(15), new Invoice(25), new Invoice(50)]);
            echo "<pre>";
                foreach($invoiceCollection as $invoice){
                    echo $invoice->id . " - " . $invoice->amount . "<br><br>";
                }
            echo "<pre>";
        


        // Array iterator
        // If iterating over an array of objects that has arrays as properties
        // IteratorAggregate is better to use than Iterator; if you need more control over iteration use Iterator        
        class InvoiceCollection1 implements IteratorAggregate{
            
            public array $invoices;

            public function __construct(array $invoices){
                $this->invoices = $invoices;
            }

           public function getIterator(): Traversable{
               return new ArrayIterator($this->invoices);
           } 
        }
        // output
        echo "Array Iterator<br>";
        $invoiceCollection1 = new InvoiceCollection([new Invoice(15), new Invoice(25), new Invoice(50)]);
            echo "<pre>";
                foreach($invoiceCollection as $invoice){
                    echo $invoice->id . " - " . $invoice->amount . "<br><br>";
                }
            echo "<pre>";



        // collection class        
        class Collection implements IteratorAggregate{

            public function __construct(array $invoices){
                $this->invoices = $invoices;
            }

            public function getIterator(): Traversable{
                return new ArrayIterator($this->invoices);
            }
        }
        
        class InvoiceCollection2 extends Collection{ }       

        // output
        echo "Array Iterator with collection class<br>";
        $invoiceCollection2 = new InvoiceCollection([new Invoice(15), new Invoice(25), new Invoice(50)]);
            echo "<pre>";
                foreach($invoiceCollection as $invoice){
                    echo $invoice->id . " - " . $invoice->amount . "<br><br>";
                }
            echo "<pre>";
            
            //typehinting, passing any type of iterable data to foreach
            function foo(iterable $iterable){ // union type can also be used e.g. Collection|array
                foreach($iterable as $item){
                    var_dump($item);
                }
            }

            echo "Typehinting<br>";
            echo foo($invoiceCollection2);
            echo foo([2, 3, 4, 5]);

       
    ?>
    
</body>
</html>