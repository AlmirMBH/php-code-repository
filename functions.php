<?php

/**
 * When defining functions within a function, the outer function must be called first
 * Otherwise, the inner functions will not be declared and an error will be thrown
 * 
 * Variables passed into the function are called parameters and their values arguments
 */

echo "<br>NESTED FUNCTIONS<br>";
foo();
bar(); 

function foo(){
    echo "Foo<br>";

    function bar(){
        echo "Bar<br>";
    }
}


/**
 * No error will be thrown if string returned because strict_type is not declared
 */
echo "<br>MIXED AND NULL RETURN TYPES<br>";
function getNum(): int {
    return '1';
}
echo getNum();


/**
 * '?' allows passing the declared type or null
 */
function getName(): ?string {
    return null;
}
echo getName();
echo  '<br>';


function getData(): mixed {
    $date = date('Y-m-d');
        if($date > '2022-11-13'){
            $res = 1;            
        }elseif ($date < '2022-11-13'){
            $res = 1.5;
        }else{
            $res = [2];
        }
    return $res;
}
echo getData();
echo  '<br>';


/**
 * Mixed type
 */
echo "<br>MIXED TYPE<br>";
function sum(int|float $num1, int|float $num2){
    return $num1 + $num2;
}
echo sum(3, 2.4);


/**
 * Passing value by reference
 */
echo "<br><br>PASSING VALUE BY REFERENCE<br>";
function passByReference(int|float &$num){
    if($num % 2 == 0){
        $num = 2;
    }
    return $num;
}

$a = 6;
echo "$a before changing it by reference<br>";
passByReference($a);
echo "$a after changing it by reference<br>";


/**
 * Variadic methods allow an indefinite number of variables to be passed
 * The '...' is most commonly called: ellipsis, unpacking operator, packing operator, 
 * three dots operator, spread operator (array within array), splat operator
 */
echo "<br>VARIADIC FUNCTIONS<br>";
function variadicFunction(...$numbers){
    $sum = 0;
    foreach($numbers as $number){
        $sum += $number;
    }
    return $sum;
}
echo "The output of the variadic function is: ", variadicFunction(12, 44, 55, 66, 66, 77, 99), "<br>";

echo "<br>ARRAY SUM<br>";
function variadicFunctionSum(...$numbers){
    return array_sum($numbers);
}
echo "The output of the variadic function sum is: ", variadicFunction(12, 44.66, 55, 66, 88), "<br>";


/**
 * Variadic methods with fixed number of parameters
 */
echo "<br>VARIADIC FUNCTIONS WITH FIXED NUMBER OF PARAMETERS<br>";
function variadicFunctionWithFixed(int $a, int|float $b, ...$numbers){
    return array_sum($numbers) + $a + $b;
}
$a = 22;
$b = 13;
$numbers = [12, 44.4, 55, 66, 77, 10];
echo "The output of the variadic function with fixed variables is: ", variadicFunction($a, $b, ...$numbers), "<br>";


echo "<br>NAMED ARGUMENS (php 8+)<br>";
function namedArguments(int $a, int|float $b){
    return $a / $b;
}
echo "The output of the named arguments function is: ", namedArguments(b: 4, a: 8), "<br>";


echo "<br>NAMED ARGUMENS WITH POSITION ARGUMENTS(php 8+)<br>";
function namedWithPositionArguments(int $a, int|float $b){
    return $a / $b;
}
echo "The output of the named with position arguments function is: ", namedArguments(8, b: 2), "<br>";


/**
 * In associative arrays, the keys will be treated as argument names
 * If position used in combination with named arguments the named arguments must be last
 */
echo "<br>SPLAT WITH ASSOCIATIVE ARRAYS<br>";
function splatWithAssociativeArrays(int $a, int $b){
    var_dump($a, $b);
    echo " = ";
    return $a + $b;
}
$numbs = ['a' => 1, 'b' => 2];
echo "The output of the splat with associative arrays is: ", splatWithAssociativeArrays(...$numbs), "<br>";
