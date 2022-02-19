<!DOCTYPE html>
<html lang="en">
<head><title>Largest and lowest array elements</title></head>
<body>    
    <h1>Largest and second largest number in array</h1>

<?php

    // largest/lowest number in array
    $array = [-7, 3, -9, 1, -10, 12];

    function largestNumber($array){

        $temp = $array[0];
        
        foreach($array as $item){
            if($item > $temp){ // change comparator to get the lowest
                $temp = $item;            
            }
        }

        return $temp;
    }
    
        echo "Largest number: " . largestNumber($array);


    // largest and second largest/lowest number in array with negative and positive numbers
    // if lowest values are required and if no negative numbers in array, 
    // $max_num_1 and $max_num_2 must be higher than 0
    $array = array(200, 200, 15, 201, -233, -444, 69, 122, 50, 201);    
        $max_num_1 = $max_num_2 = 0; 

        for($i=0; $i<count($array); $i++){
            
            // change comparators to get the lowest and second lowest
            if($array[$i] > $max_num_1){ 
                $max_num_2 = $max_num_1;
                $max_num_1 = $array[$i];
            }else if($array[$i] > $max_num_2 && $array[$i] != $max_num_1){ 
                $max_num_2 = $array[$i];
            }
        }

        echo "<br>Largest and second largest number<br>";
        echo "MAX 1: " . $max_num_1 . "<br>";
        echo "MAX 2: " . $max_num_2;
?>

</body>
</html>