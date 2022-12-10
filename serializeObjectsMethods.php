<!DOCTYPE html>
<html lang="en">
<head><title>Serialize objects and magic methods</title>
</head>
<body>
    <h1>Serialize objects and magic methods</h1>

    <?php
    
        // resource types, closures and some built-in php objects cannot be serialized
        
        const NLINE = '<br>';

        // (un)serialize
        $ser = serialize("Almir");
        echo $ser . NLINE;
        echo unserialize($ser) . NLINE;

        
        // object serialization
        // if one of the fields shulold not be serialized, but encrypted, use
        // Serializable interface
        // 4 magic methods are related with serialization: sleep, wakeup, (un)serialize
        // __serialize() has precedence over __sleep(), which will be ignored (not called) and the same applies
        // to __unserialize() that has precedence over __wakeup()
        
        class Invoice{
            private string $id;         
            public string $number;   

            public function __construct($id, $number){ 
                // $this->id = uniqid('invoice_');                         
                // $this->number = rand(12, 44);
                $this->id = $id;                         
                $this->number = $number;
            }      
            
            // called before the serialization; can be used to pre-serialize sth e.g. which properties to serialize
            // It must return an array of properties to be serialized; no additional info like __serialize()

            public function __sleep(){
                return ['id'];
            }

            // called after the unserialization; note: DB connections, resources etc. cannot be serialized and this
            // method is called to restored them after the object has been unserialized (lost during serialization)
            
            public function __wakeup(){
                
            }

            // gets called prior to serialization, just like the _sleep(); 
            // it must return an array that represents an object and in addition it can contain additional info
            
            public function __serialize(){
                return [
                    'id' => $this->id,
                    'number' => base64_encode($this->number),
                    'foo' => 'bar' // additional info that is not class property
                ];
            }

            // gets called after an object has been unserialized; it gets the serialized data as an argument
            // note: DB connections, resources etc. cannot be serialized and this method is called to restored 
            // them after the object has been unserialized (lost during serialization)

            public function __unserialize(array $data){
                // var_dump($data);
                $this->id = $data['id'];
                $this->number = base64_decode($data['number']);
            }

        }
        

        // after unserializing an object, a new object is created ('deep copying') and it does
        // not point to the same memory location

        $invoice = new Invoice(9, 33567);
        $serObj = serialize($invoice);
        $invoice2 = unserialize($serObj);
        
        
        echo '<br><pre>';
            var_dump($serObj);        

            // false; different locations
            var_dump($invoice, $invoice2, $invoice === $invoice2);
        
            // true as properties are the same; might behave differently if __sleep, __wakeup, 
            // __(un)serialize are used; comment out these 4 methods above to get true as a result here
            var_dump($invoice == $invoice2); 

        echo '</pre>';
        
        

    ?>
    
</body>
</html>