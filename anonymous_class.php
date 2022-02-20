<!DOCTYPE html>
<html lang="en">
<head><title>Anonymous class</title>
</head>
<body>
    <h1>Anonymous class</h1>

    <?php
    
        // saves memory
        $anonymousClass = new class(){
            public $name = "John";
            public function hello(){
                echo "Hello!";
            }
        };

       $anonymousClass->hello();
       echo $anonymousClass->name;
    
    ?>
    
</body>
</html>