<!DOCTYPE html>
<html lang="en">
<head><title>Anonymous class</title>
</head>
<body>
    <h1>Anonymous class</h1>

    <?php

        const NLINE = "<br>";

        class PersonClass{
            protected $person = "Almir";
            public function __construct(){ }
            public function getPerson(){ return $this->person; }

            public function getPersonObj() :object{ 
                return new class extends PersonClass{ // anonymous can extend its wrapper class
                    public function __construct(){
                        parent::__construct();
                        echo $this->getPerson();
                    }
                };
            }
        }

        interface NameInterface{
            public function getName();
        }

        trait HumanTrait{
            public function getActivity(){ return "walking"; }
        }
    
        // saves memory
        $anonymousClass = new class() extends PersonClass implements NameInterface{
            use HumanTrait;

            public $name = "John";
            public function __construct(){ }            
            public function hello(){ echo "Hello!"; }
            public function getName(){ return $this->name; }
        };

        
        //anonymous class can't be typehinted but e.g. interface or 'object' can 
        function getAnonymousClass(NameInterface $class){  var_dump($class); }

        // output
        echo $anonymousClass->name . NLINE;
        echo $anonymousClass->getName() . NLINE;
        echo $anonymousClass->getPerson() . NLINE;
        $anonymousClass->hello(); echo NLINE;
        $anonymousClass->getPersonObj(); echo NLINE;    
        echo get_class($anonymousClass);

        

        echo NLINE;
        getAnonymousClass($anonymousClass);
    
    ?>
    
</body>
</html>