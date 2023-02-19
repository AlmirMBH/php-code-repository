<?php

/**
 * Variable functions do not work with constructs like isset, empty, unset, print, echo, include, require, etc.
 * Wrapper functions around them need to be created around them and called instead.  
 * Callable, closure and arrow functions
 */
 echo "CALLABLE FUNCTIONS<br>";
 function sum(...$numbers){
    return array_sum($numbers);
 }

 $x = 'sum';

 if(is_callable($x)){
    echo $x(1, 2, 3, 8), "<br>";
}
else{
    echo "Not callable", "<br>";
}


/**
* Anonymous or lambda functions have no name and must end with ';'. 
* Functions that can access variables out of their local scope are called anonymous functions or closures.
*/
echo "<br>ANONYMOUS FUNCTIONS<br>";
$sum = function (...$numbers){
    return array_sum($numbers);
 };
 echo $sum(1, 4, 7, 9), "<br>";


/**
 * Functions that can access variables out of their local scope are also called closures. The variables
* outside the function scope are copied into functions and if not passed by reference 
* the functions do not change their outside value
*/
 echo "<br>ANONYMOUS / CLOSURE FUNCTIONS WITH USE<br>";
 $a = 1;
 $sum2 = function (...$numbers) use(&$a): int{
    $a = 3;
    return array_sum($numbers) + $a;
 };
 echo $sum2(1, 4, 7, 9), "<br>";
 echo $a, "<br>";


/**
* Callback function is a function that is passed to other function as an argument and then
* it is called within that function. It happens in array_map, array_filter, usort etc.
*/
echo "<br>CALLBACK FUNCTIONS<br>";
$array = [1, 2, 3, 4];
$array2 = array_map(function($element){
    return $element * 2;
}, $array);


$function = function($element){
    return $element * 3;
};
$array3 = array_map($function, $array);


function foo($element){
    return $element * 4;
};
$array4 = array_map('foo', $array);


echo "<pre>";
print_r($array);
print_r($array2);
print_r($array3);
print_r($array4);
echo "</pre>";


/**
 * It is possible to typehint $callbac as callable (can be a regular function) 
 * or closure (must be an anonymous function)
 */
$sum2 = function(callable $callback, int|float ...$numbers): int|float{
    return $callback(array_sum($numbers)); // applying foo2 to the result of array_sum
};

function foo2($element){
    return $element * 5;
}

echo "Modifying array_sum result via callback: ", $sum2('foo2', 1, 2, 3, 4), "<br>";

/**
 * Functions like this are automatically converted to instances of closures
 */
echo "Modifying array_sum result via anonymous function: ", $sum2(function($element){
    return $element * 7;
}, 1, 3, 5, 7, 9), "<br>";


echo "<br>ARROW FUNCTIONS (php 7.4)<br>";
$array = [4, 8, 12, 16];
$array2 = array_map(function($element){
    return $element * 2;
}, $array);


/**
 * Arrow functions can always access variables outside their own scope without the key word 'use'.
 * It is bi-value variable binding, which means that variables from the parent scope cannot be modified in
 * the function.
 * Arrow functions have single line expressions by default and multiple line expressions must be in an array.
 */
$g = 1;
$array3 = array_map(fn($element) => $element * 3 * ++$g, $array);
$array4 = array_map(fn($element) => 
    [$sum = $element * 4,
     $sum = $sum * ++$g
    ]
    , $array); 


echo "<pre>";
print_r($array2);
print_r($array3);
print_r($array4);
echo "Parent scope variable used in arrow function: ", $g, "<br>";
echo "</pre>";

