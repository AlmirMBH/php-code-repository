<?php

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