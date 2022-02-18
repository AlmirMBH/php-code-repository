<!DOCTYPE html>
<html lang="en">
<head><title>Static properties and methods</title></head>
<body>
    <h1>Static properties and methods</h1>

<?php

    // When a property within a class does not have to be related with any
    // instance / object, it should be declared static

    class Person{

        private $name;
        private $age;
        private $email;

        public static $drivingLicence = 18;

        public function __construct($name, $age, $email){
            $this->name = $name;
            $this->age = $age;
            $this->email = $email;
        }

        public static function setDrivingLicence($drivingL){
            self::$drivingLicence = $drivingL;
        }

        public static function getDrivingLicence(){
            return self::$drivingLicence;
        }
    }

    Person::setDrivingLicence(22);
    echo Person::$drivingLicence;
    echo Person::getDrivingLicence();
?>

</body>
</html>