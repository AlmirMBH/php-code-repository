<?php

/**
 * O - describes an uppwer bound of the running time of algorithm i.e. how many steps an
 * algorithm might take
 * A list of commonly seen running times in the real world
 * O(n^2)
 * O(n log n)
 * O(n)
 * O(log n)
 * O(1) - order of a single step, constant time, the best, a constant number of steps
 * 
 * Ω - describes a lower bound of the running time of algorithm i.e. how few steps an
 * algorithm might take (best case)
 * Ω(n^2)
 * Ω(n log n)
 * Ω(n)
 * Ω(log n)
 * Ω(1)
 * 
 * Θ (theta) - used when O (upper bound) and Ω (lower bound) are the same
 * Θ(n^2)
 * Θ(n log n)
 * Θ(n)
 * Θ(log n)
 * Θ(1)
 * 
 * Most common algorithm is the linear search i.e. from the lowest to the highest index of an array, especially if the
 * array is not ordered from the lowest to the highest value or in any other logical way.
 * The loop below is the exmple of O(n). It does have only one step but the number of iterations is variable and can be
 * infinite. O(n) is in the current situation also the upper bound.
 * Ω(1) for this example would be achieved if number 5 is in the initial position of the array i.e. [5, 4, 3, 2, 1].
 * 
 * for([1, 2, 3, 4, 5] as $num){ 
 * if($num == 5) 
 *      return $num 
 * }
 * 
 * Binary search, also called divide and conquer algorithm means that an array i split into 2 and then an element 5 is
 * compared with number 3. If it is higher, the right side of the array is retained and the process is repeated until
 * 5 is found. The largest number of looping to find an element in an array of n elements is O(log n) i.e. a number of
 * times the array can be split into 2. This is the upper bound, while the lower bound would be to find the element on
 * the first array splitting Ω(1).
 */
$a = 0;
$b = 0;

echo "WHILE<br><br>";
while(true){
    while($a > 10){
        // breaks two levels of loop when the condition is fulfilled, otherwise infinite loop
        break 2;
    }
    echo $a++, ", ";
}
echo "<br>";

while($b <= 15):
    $b++;    
    if ($b % 2 === 0)
        continue;
    else
        echo $b++, ", ";    
endwhile;


echo "<br><br>FOR<br>";
$text = ['a', 'b', 'c', 'd'];

for($c = 0; $c < 10; print $c . ", ", $c++){ }
echo "<br>";
for($c = 0; print $c . ", ", $c < 10; $c++){ }
echo "<br>";

// calling count on large arrays in each itteration might lead to performance issues
for($d = 0; $d < count($text); $d++){
    echo $text[$d], ", ";
}

echo "<br>";
// instead of calling count on large arrays in each itteration, call it only once
// $length = count($text);
for($d = 0; $length = count($text), $d < $length; $d++){
    echo $text[$d], ", ";
}


echo "<br><br>FOREACH<br>";
$arr = ['a', 'b', 'c', 'd'];

// by value
foreach($arr as $key => $value){
    echo $key . ": ", $value . "; ";
}

$arr2 = ['g', 'h', 'c', 's'];
echo "<br>";
print_r($arr2);
echo "<br>";

// by reference to change the original element of the array
foreach($arr2 as $key => &$value){
    $value = "php";
}

// $value is not destroyed after the loop is completed and can cause issues; destroy it
echo $value;
unset($value);
echo($value);

echo "<br>";
print_r($arr2);
echo "<br>";


echo "<br>MATRIX<br>";
$arr3 = [
    'name' => 'Almir', 
    'email' => 'almir@almir.ba', 
    'skills' => ['php', 'laravel', 'sql']
];

// skills field is array and cannot be converted to string; use json_encode, implode or nested loop
// option 1
foreach($arr3 as $key => $value){
    if(is_array($value)){
        $value = implode(', ', $value);
    }
    echo $key . ": ", $value . "<br>";
}
unset($key, $value);

// option 2
echo "<br>";
foreach($arr3 as $key => $value){
    echo $key . ": ";
    if(! is_array($value)){
        echo $value . "<br>";
    }
    else if(is_array($value)){
        foreach($value as $skill){
            echo $skill . " - ";
        }
    }
}
unset($key, $value);
// option 2-1 short syntax
echo "<br><br>";
foreach($arr3 as $key => $value):
        echo $key . ": ";
    if(is_array($value)):
        foreach($value as $skill):
            echo $skill . " - ";
        endforeach;
    else:
            echo $value . "<br>";    
    endif;
endforeach;
unset($key, $value);

// option 3
echo "<br><br>";
foreach($arr3 as $key => $value){
    echo $key . ": ", json_encode($value) . "<br>";
}
unset($key, $value);


echo "<br>DRAW A PYRAMID<br>";
function draw(int $n){
 
    if($n <= 0){
        return;
    }

    $var = draw($n - 1);
    
    for($i = 0; $i < $n; $i++){
        echo "#";
    }
    echo "<br>";

    // draw($n - 1); Seha, what happens when this line is not commented out and line 176 is? Why?
}

draw(4);

// expected result
// #
// ##
// ###
// ####