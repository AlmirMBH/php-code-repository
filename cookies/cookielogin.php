<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1>Cookie login</h1>

    <form action="cookielogin.php" method="post">
    <input type="text" name="username" placeholder="Enter your username"><br>
    <input type="text" name="password" placeholder="Enter your password"><br>
    <button>Login</button>
    </form>

    <?php
    
    if(isset($_POST['username']) and isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username != '' and $password != ''){
            setcookie('id', '1', time()+60, '/');
            setcookie('username', $username, time()+60, '/');            
            setcookie('status', 'Administrator', time()+60, '/');

            // echo "You are logged in!";
            header("Location: cookiestranica.php");
        }else{
            echo "All fields are required!";
        }
    }else{
        echo "Welcome to our website!";
    }
    
    
    ?>

</body>
</html>