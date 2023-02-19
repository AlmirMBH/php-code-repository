<?php
    $message = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Setup</title>
</head>
<body>
    
    <form action="pagecolorsetup.php" method="post">
        <select name="bgcolor" id="bgcolor">
            <option value="0">-- Select background --</option>
            <option value="red"> Red </option>
            <option value="blue"> Blue </option>
            <option value="green"> Green </option>
            <option value="white"> White </option>
        </select>
        <br><br>
        <select name="font" id="font">
            <option value="0">-- Select font color --</option>
            <option value="red"> Red </option>
            <option value="blue"> Blue </option>
            <option value="green"> Green </option>
            <option value="white"> White </option>
        </select>
        <br><br>
        <select name="font_size" id="font_size">
            <option value="0">-- Select font size --</option>
            <option value="16px"> 16px </option>
            <option value="18px"> 18px </option>
            <option value="20px"> 20px </option>
            <option value="22px"> 22px </option>
        </select>
        <br><br>
        <button>Save setup</button>
    </form>
    <hr>

    <?php
        if(isset($_POST['bgcolor']) and isset($_POST['font']) and isset($_POST['font_size'])){
            $background = $_POST['bgcolor'];
            $font = $_POST['font'];
            $font_size = $_POST['font_size'];

                if($background != '0' and $font != '0' and $font_size != '0'){
                    setcookie('background', $background, time()+60, '/');
                    setcookie('font', $font, time()+60, '/');
                    setcookie('font_size', $font_size, time()+60, '/');
                    $message = 'Your settings have been recorded!';
                    header("Location: page.php");
                }else{
                    setcookie('background', '', time()-1, '/');
                    setcookie('font', '', time()-1, '/');
                    setcookie('font_size', '', time()-1, '/');
                    $message = 'Your background and font color have not been set!';
                }
        }else{
            echo "Welcome, set your favorite colors!";
        }
    ?>

    <div><?php echo $message; ?></div>

</body>
</html>