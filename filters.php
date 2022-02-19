<?php
// ALL THE FILTERS PROVIDED AT THE END OF THIS FILE

// CHECK FOR POSTED DATA
/*
if(filter_has_var(INPUT_POST, "data")){  // INPUT_POST must be the same as the from method and DATA the same as the form input name
    echo "Data Found";
}else{ echo "Data Not Found";    
     }
  */
// VALIDATION OF DATA (CHECKING IF EMAIL HAS IRREGULARITIES)
//if(filter_has_var(INPUT_POST, "data")){
//    if(filter_input(INPUT_POST, "data", FILTER_VALIDATE_EMAIL)){
//        echo "Email is valid";
//    }else{
//        echo "Email is not valid";
//    }
//}

// REMOVING ILLEGAL CHARACTERS (SANITIZING) FROM EMAIL

if(filter_has_var(INPUT_POST, "data")){
    $email = $_POST["data"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    echo $email."<br>";

// VALIDATING EMAIL    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Email is valid. ";
    }else{
        echo "Email is not valid. ";
    }
}
echo "<br/>";

// VALIDATING INTEGER

$var = "P3";

if(filter_var($var, FILTER_VALIDATE_INT)){
    echo $var." is a number";
}else{
    echo $var." is not a number";
}
echo "<br>";
// SANITIZING INTEGER

$var1 = "ksjbkbskbsd3346";

var_dump(filter_var($var1, FILTER_SANITIZE_NUMBER_INT));   echo "<br>";


// PREVENTING SCRIPTS

$var2 = "<script>alert(1)</script>";

var_dump(filter_var($var2, FILTER_SANITIZE_SPECIAL_CHARS));   echo "<br>";

// DEALING WITH MORE INPUT FIELDS (USING FILTERS)

$filters = array(
    "data" => FILTER_VALIDATE_EMAIL,
    "data2" => array(
        "filter" => FILTER_VALIDATE_INT,
        "options" => array(
            "min_range" => 1,
            "max_range" => 100
        ),        
    ),    
);

print_r(filter_input_array(INPUT_POST, $filters)); echo "<br>";

// VERIFYING USER DATA

$user = array(
    "name" => "Almir",
    "age" => 40,
    "email" => "almir.mustafic.tz@gmail.com"    
);

$userFilter = array(
    "name" => array(
        "filter" => FILTER_CALLBACK, // FILTER_CALLBACK invokles the first variable above ($user)
        "options" => "ucwords"
    ),
    "age" => array(
        "filter" => FILTER_VALIDATE_INT,        
        "options" => array(
        "min_range" => 1,
        "max_range" => 120,
        )
    ),    
    "email" => FILTER_VALIDATE_EMAIL                
);

print_r(filter_var_array($user, $userFilter)); echo "<br>";


?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="data">
    <input type="text" name="data2" value="Enter Number" >
    <button type="submit">Submit</button>
</form>

<?php

# FILTER_VALIDATE_BOOLEAN
# FILTER_VALIDATE_EMAIL
# FILTER_VALIDATE_FLOAT
# FILTER_VALIDATE_INT
# FILTER_VALIDATE_IP
# FILTER_VALIDATE_REGEXP
# FILTER_VALIDATE_URL

# FILTER_SANITIZE_EMAIL
# FILTER_SANITIZE_ENCODED
# FILTER_SANITIZE_NUMBER_FLOAT
# FILTER_SANITIZE_NUMBER_INT
# FILTER_SANITIZE_SPECIAL_CHARS
# FILTER_SANITIZE_STRING
# FILTER_SANITIZE_URL

?>