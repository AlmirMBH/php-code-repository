<!DOCTYPE html>
<html lang="en">
<head><title>Late static binding</title></head>
<body>

<h1>Late static binding</h1>
    <!-- Early binding -> compile time -->
    <!-- Late binding -> runtime -->

<?php

    class ClassA{
        
        protected string $name = 'Almir';

        public function getName() : string{
            //var_dump(get_class($this));
            return $this->name;
        }
    }


    class ClassB extends ClassA{
        
        protected string $name = 'Bill';
        
    }


    $classA = new ClassA();
    $classB = new ClassB(); // late binding; class resolved at runtime using the runtime information

    echo $classA->getName() . "<br>";
    echo $classB->getName() . "<br>";


    

    class ClassC{
        
        protected static string $name = 'Claire';

        public static function getName() : string{            
            // var_dump(self::class);
            // var_dump(get_called_class());
            // return self::$name; // early binding; resolves the class at compile time
            return static::$name; // late static binding
        }

        public static function make(){
            // return new ClassC(); // hard-coded class instantiation
            // return new self(); // even if make() is called from class D, this line will return class C
            return new static(); // the right solution to enable 'extends' in classD below
        }
    }


    class ClassD extends ClassC{
        
        protected static string $name = 'Danny';
        
    }
    

    echo "<br>";
    echo ClassC::getName() . "<br>";
    echo ClassD::getName() . "<br>";
    var_dump(ClassC::make());
    echo "<br>";
    var_dump(ClassD::make());

?>

</body>
</html>