<?php

/**
 * 'Under the hood', strings are implemented as arrays of characters (1 byte).
 * https://www.youtube.com/watch?v=8mAITcNt710&ab_channel=freeCodeCamp.org (05:19:40)
 * Strings in memory are delineated by a 'nul character' i.e. '\0' (8 byts), and each string has this character
 * at the end (can be seen by index in C language). All the other data types are finite regarding the number of bytes
 * and, therefore, they are clearly delineated.
 * New line '\n' is stored as one character (1 byte).
 */
// SUBSTRING
$output = substr("Hello", 1, 3);
echo $output;
echo "<br>";

$output1 = substr("Hello", -4);
echo $output1;
echo "<br>";

// LENGTH OF STRING
$output2 = strlen("Hello World");
echo $output2;
echo "<br>";

// INDEX OF AN ELEMENT OF A STRING
$output3 = strpos("Hello World", "o"); // The first occurence of the searched element "o"
echo $output3;
echo "<br>";

$output4 = strrpos("Hello World", "o"); // The last occurence of the searched element "o"
echo $output4;
echo "<br>";

// TIMMING STRINGS
$text = "hello world                ";   // This string has 27 elements
var_dump($text);
echo "<br>";

$trimmed = trim($text);
var_dump($trimmed);    // This function trims all the 'empty' elements    
echo "<br>";

// CAPITALIZING THE FIRST LETTERS OF WORDS OF A STRING
$firstLetter = ucwords($trimmed);
echo $firstLetter;
echo "<br>";

// CHECKING IF AN ELEMENT OF ARRAY IS A STRING (FOREACH & IF LOOPS)
$val = "Hello";
$output5 = is_string($val);
echo $output5;
echo "<br>";

$values = array(true, false, null, 'abc', 33, '33', 22.4, '22.4', '', ' ', 0, '0');

foreach($values as $value){
    if(is_string($value)){
        echo "{$value} is a string <br>";
    }    else{
        echo"{$value} is not a string <br>";
    }
}

// COMPRESSING STRINGS

$longString = "Lorem Ipsum is simply dummy text of the printing and typesetting industry
               Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
               when an unknown printer took a galley of type and scrambled it to make a type
               specimen book. It has survived not only five centuries, but also the leap into
               electronic typesetting, remaining essentially unchanged. It was popularised in
               the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
               and more recently with desktop publishing software like Aldus PageMaker including
               versions of Lorem Ipsum.";

$compressed = gzcompress($longString);
echo $compressed; 
echo "<br>";
$original = gzuncompress($compressed);
echo $original;












