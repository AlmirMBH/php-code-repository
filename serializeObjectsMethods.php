<!DOCTYPE html>
<html lang="en">
<head><title>Serialize objects and magic methods</title>
</head>
<body>
    <h1>Serialize objects and magic methods</h1>

    <?php
    
        /**
         * Unlike cloning, which is also called shallow copying, serialization is deep copying.
         * Resource types, closures and some built-in php objects cannot be serialized.
         * 
         * Object serialization
         * If one of the fields shuold not be serialized but encrypted it is possible to use Serializable interface. 
         * Bear in mind that the Serializable interface is deprecated in php 8.1. and it will be removed in php 9.
         * Therefore, magic methods are used for this purpose instead of the Srializable interface.
         * 4 magic methods are related with serialization: sleep, wakeup, serialize, unserialize
         * 
         * IMPORTANT
         * Method Precedence
         * __serialize() has precedence over __sleep(), which will be ignored (not called), if both methods are
         * used and the same applies to __unserialize() that has precedence over __wakeup()
         * 
         * If objects are serialized their methods will not be serialized; only properties can be serialized.
         */

         echo "SERIALIZATION OF DATA TYPES<br>";
        const NLINE = '<br>';

        echo serialize(true), NLINE;
        echo serialize(1), NLINE;
        echo serialize(2.5), NLINE;
        echo serialize("Almir"), NLINE;
        echo serialize([1, 2, 3]), NLINE;
        echo serialize(['a' => 1, 'b' => 2, 'c' => 3]), NLINE;
        
        $user = serialize("Almir");
        echo unserialize($user) . NLINE;
        
        class Invoice{
            
            public function __construct(
                private string $id,
                public float $amount,
                public string $description,
                public string $creditCardNumber 
            ){ 
                $this->id = uniqid('invoice_');                         
                // $this->creditCardNumber = rand(12, 44);                
            }      
            

            /**
             * Called before the serialization; can be used to pre-serialize sth e.g. which properties
             * to serialize. It must return an array of properties to be serialized; 
             * no additional info like __serialize()
             */
            public function __sleep(){
                return ['id', 'amount'];
            }


            /**
             * Called after the unserialization;
             * NOTE: DB connections, resources etc. cannot be serialized and this method is called to restored 
             * them after the object has been unserialized (lost during serialization).
             */
            public function __wakeup(){
                
            }


            /**
             * Gets called prior to serialization, just like the _sleep(). 
             * It must return an array that represents an object and in addition it can contain additional info.
             * The difference between sleep and serialize is that the sleep method must return the names of the
             * properties that need to be serialized, while the serialize method must return an (associative)
             * array that represents the object.
             * 
             * If FALSE is serialized the unserialization will always return false and it might cause issues.
             * In order to avoid the issue, compare the result of the unserialization and check if the return
             * value is an error or a boollean value.
             */
            public function __serialize(){
                return [
                    'id' => $this->id,
                    'amount' => $this->amount,
                    'description' => $this->description,
                    'creditCardNumber' => base64_encode($this->creditCardNumber),
                    'foo' => 'bar' // additional info that is not class property
                ];
            }


            /**
             * Gets called after an object has been unserialized; it gets the serialized data as an argument.
             * NOET: DB connections, resources etc. cannot be serialized and this method is called to restore
             * them after the object has been unserialized (lost during serialization).
             */
            public function __unserialize(array $data){
                // var_dump($data);
                $this->id = $data['id'];
                $this->amount = $data['amount'];
                $this->description = $data['description'];
                $this->creditCardNumber = base64_decode($data['creditCardNumber']);
            }

        }
        

        /**
         * After unserializing an object, a new object is created ('deep copying') and it does not point to 
         * the same memory location as the original object (see invoice and invoice2 comparison below).
         */
        echo "<br>SERIALIZATION OF OBJECTS";
        $invoice = new Invoice(9, 33567, 'Invoice 1', 'ABC-22');
        $serObj = serialize($invoice);        
        $invoice2 = unserialize($serObj);        
        
        echo '<pre>';
            var_dump($serObj);                    
            var_dump($invoice);
            echo NLINE;
            var_dump($invoice2);
            echo NLINE;

            /**
             * True as properties are the same; might behave differently if __sleep, __wakeup, 
             * __(un)serialize are used; comment out these 4 methods above to get true as a result here
             */
            var_dump($invoice == $invoice2); 

            /**
             * False; different memory locations (pointers in the zend value / container)
             */
            var_dump($invoice === $invoice2);
        echo '</pre>';
        
        

    ?>
    
</body>
</html>