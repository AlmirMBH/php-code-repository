<!DOCTYPE html>
<html lang="en">
<head><title>Constants and statics</title></head>
<body>
    
    <?php

        /**
         * 'const' defined at compile time; cannot be defined within control structures e.g. loops or if statements
         * 'define' is defined at runtime and can be defined within control structures and if statements e.g. 
         * if (true){ define('STATUS', 9)}
         */
        define('TEST_CONSTANT', 'test'); 
        const GLOBAL_EXAMPLE = "This cannot be changed!"; 

        function checkIfGlobalExists(){
            return defined('GLOBAL_EXAMPLE') . "<br>";
        }

        $statusPaid = 9;
        $paid = 'PAID';
        define('STATUS_' . $paid , $statusPaid);
        echo "Status paid is: " . STATUS_PAID . "<br>";

        /**
         * Predefined PHP constants
         */
        echo PHP_VERSION . "<br>";
        echo PHP_EXTENSION_DIR . "<br>";
        echo "Line in which magic constant is used: " . __LINE__ . "<br>";
        echo "File in which magic constant is used: " . __FILE__ . "<br>";


        /**
         * Variable variable
         */
        $foo = 'bar';
        $$foo = 'baz'; // the same as $bar = 'baz'
        echo $foo, " ", $bar, "<br>"; 
        echo $$foo, "<br>"; 
        echo "${$foo}<br>"; 


        
        class FirstClass{            
            const EXAMPLE = "This cannot be changed!";

            public static function fClass(){
                $test = self::EXAMPLE . "<br>";
                return $test;
            }

            public static function checkIfGlobalConstantExists(){
                return defined('TEST_CONSTANT') . "<br>";
            }
        }


        class SecondClass extends FirstClass{
            public static $staticProperty = "This is a static property!";

            public static function sClass(){
                echo parent::EXAMPLE . "<br>";
                echo self::$staticProperty . "<br>";
            }
        }
    
        echo FirstClass::fClass();
        echo checkIfGlobalExists();
        echo FirstClass::checkIfGlobalConstantExists();
        echo SecondClass::sClass();



    ?>
</body>
</html>