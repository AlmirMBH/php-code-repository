
<?php

$bgcolor = 'white';
$font = 'black';
$font_size = '16px';
if(isset($_COOKIE['background']) and isset($_COOKIE['font']) and isset($_COOKIE['font_size'])){
    $bgcolor = $_COOKIE['background'];
    $font = $_COOKIE['font'];
    $font_size = $_COOKIE['font_size'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="color:<?php echo $font; ?>; background-color:<?php echo $bgcolor?>; font-size: <?php echo $font_size ?>">
    <h1>Page</h1>

    <?php
        echo "<a href='cookielogout.php'> Sign out </a>";
    ?>
    
</body>
</html>