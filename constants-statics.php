<!DOCTYPE html>
<html lang="en">
<head><title>Constants and statics</title></head>
<body>
    
    <?php
        class FirstClass{

            const EXAMPLE = "This cannot be changed!";

            public static function fClass(){
                $test = self::EXAMPLE . "<br>";
                return $test;
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
        echo SecondClass::sClass();



    ?>
</body>
</html>