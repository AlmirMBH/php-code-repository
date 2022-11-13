<!DOCTYPE html>
<html lang="en">
<head><title>Data types</title></head>
    <body>
        
        <?php 
        /**
         * 1) Scalar types
         *    a) bool
         *    b) int
         *    c) float
         *    d) string        
         * 2) Compund types
         *    a) array
         *    b) object    
         *    c) callable
         *    d) iterable    
         * 3) Special types
         *    a) resource
         *    b) null  
         * 
         * In dynamically-typed languages type checking happens at runtime, while in statically-typed languages
         * type checking happens at compile time
         * 
         * Operator precedence: https://www.php.net/manual/en/language.operators.precedence.php
         */

         /**
          * Boolean
          * int 0 and -0 = false
          * floats 0.0 and - 0.0 = false
          * string '' and '0' = false
          * array [] = false
          * null = false
          */

          /**
           * Bytes
           */
          echo "<br>Bytes<br>";
          $var1 = 6; // 110
                     // &
          $var2 = 3; // 011
                     // 010 = 2
          var_dump($var1 & $var2);
          echo "<br>";

          $var1 = 6; // 110
                     // |
          $var2 = 3; // 011
                     // 111 = 7
          var_dump($var1 | $var2);
          echo "<br>";

          $var1 = 6; // 110
                     // ^
          $var2 = 3; // 011
                     // 101 = 5
          var_dump($var1 ^ $var2);
          echo "<br>";

          $var1 = 6; // 110
                     // ~
                     // 001
                     // &
          $var2 = 3; // 011                     
                     // 001 = 1
          var_dump(~$var1 & $var2);
          echo "<br>";

          $var1 = 6; // 110
                     // <<<
                     // 110000 = 6 * 2 * 2 * 2
          $var2 = 3; 
          var_dump($var1 << $var2);
          echo "<br>";

          $var1 = 6; // 110
                     // >>>
                     // 11 = 3 (1 bit discarded) or 6 / 2
          $var2 = 1; 
          var_dump($var1 >> $var2);
          echo "<br>";


          /**
           * Integers
           */
          echo "<br>Integers<br>";
          echo PHP_INT_MIN . "<br>";
          echo PHP_INT_MAX . "<br>";
          echo PHP_INT_SIZE . "<br>";

          var_dump(PHP_INT_MAX);
          echo "<br>";
          echo 200_000_000 . "<br>"; // underscore can be used to improve code readability
          var_dump(PHP_INT_MAX + 1); // auto-casting to float
          echo "<br>";

          echo "<br>Division of integers by zero and fdiv<br>";
          $x = 10;
          $y = 0;
          var_dump(fdiv($x, $y));          
          echo "<br>";
          $int1 = ($int2 = 10) + 5;
          echo $int1, "<br>";        
          echo $int2, "<br>";          
          

          /**
           * Floats
           */
          echo "<br>Floats<br>";
          $a = 13.5e3; // exponential form
          echo $a . "<br>";
          $b = 13.5e-3; // exponential form negative
          echo $b . "<br>";
          echo PHP_FLOAT_MIN . "<br>";
          echo PHP_FLOAT_MAX . "<br>";

          echo "<br>Modulo and fmod<br>";
          $float1 = 10.5;
          $float2 = 2.9;
          var_dump($float1 % $float2);
          echo "<br>";
          var_dump(fmod($float1, $float2)); // if the number that is being divided is negative the result will be negative
          echo "<br>";
          
          /**
           * The result of the below floor operation will be 7
           * The reason is that 0.1 and 0.7 do not have the same representation as the floating numbers in base 2
           * which is binary (used internally to store floats)
           * In reality, the exact result is 7.9999999999999991118 and when 'floored' it rounds to 7
           * Similarly, the result of ceil operation is 4.
           * Floats should never be compared as in case of $e and $f
           */
          $c = floor((0.1 + 0.7) * 10);
          $d = ceil((0.1 + 0.2) * 10);
          var_dump(is_infinite($d));
          echo $b . "<br>";
          var_dump(is_nan($d));
          echo $c . "<br>";
          echo $d . "<br>";

          $e = 0.23;
          $f = 1 - 0.77;

          if($e == $f){
            echo "$e and $f are the same<br>";
          }else{
            echo "$e and $f are not the same<br>";
          }


          /**
           * Strings
           * Heredoc (doble quotes) parses variables
           * Nowdoc (single quotes) cannot parse variables
           */
          echo "<br>Strings<br>";          
          $name = "Will Smith";
          $name[2] = 'P';
          $name[44] = 'G';
          echo $name[-2] . "<br>"; // t
          echo $name . "<br>";
          // php 8 and newer versions cast int to string not the other way round as in previous versions of php
          echo "String compared with integer: ", var_dump($name == 0); // false
          echo "<br>";

          $string = 'abc';
          echo $string, "<br>";
          echo ++$string, "<br>";

          $bool1 = true;
          $bool2 = false;
          $bool3 = $bool1 and $bool2; // assignment operator has higher precedence than 'and' but lover than '&&'
          $bool4 = ($bool1 and $bool2);
          $bool5 = $bool1 && $bool2;
          var_dump($bool3);
          echo "<br>";
          var_dump($bool4);
          echo "<br>";
          var_dump($bool5);
          echo "<br>";

          $greeting = "Hello world";
          $index = strpos($greeting, 'H');
          // 'H' is at position 0 and 0 compared with false is true        
          if($index === false){
              echo "H not found at position ${index} if strict comparison used<br>";
          }elseif($index == false){ 
              echo "H found if value comparison used<br>";
          }else{
              echo "H not found <br>";
          }

          // even if $tt is not defined, no error will be thrown (null coalescing operator)
          $t = $tt ?? 'Good afternoon<br>';
          var_dump($t);

          // heredoc
          $text = <<<TEXT
          Line 1 $a
          Line 2 $b
          Line 3 $c
          <div><p>The space in html is rendered as is</p></div>
          TEXT;

          echo nl2br($text);
          echo "<br>";

          // nowdoc
          $text2 = <<<'TEXT'
          NLine 1
          NLine 2
          NLine 3
          TEXT;

          echo nl2br($text2);
          echo "<br>";
          

          /**
           * Null data type
           * 
           * When something is being echoed, it is first cated to a string
           * Null is casted to an empty string 
           */
          echo "<br>Null data type<br>";
          $g = null;
          echo 'Printing $g as string: ', var_dump((string) $g) . "<br>";
          echo 'Printing $g as array: ', var_dump((array) $g) . "<br>";
          echo 'Printing $g:' . $g . "<br>"; 
          echo 'Check if $g is null: ', var_dump(is_null($g)), var_dump($g === null) . "<br>";
          var_dump($g);
          echo "<br>";


          /**
           * Arrays
           */
          echo "<br>Arrays<br>";
          $arr1 = ['a', 'b', 'c'];
          $arr2 = ['d', 'e', 'f', 'g', 'h'];          
          var_dump($arr1 + $arr2);

          echo "<br>";
          $arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
          $arr2 = ['1' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8];
          var_dump($arr1 + $arr2);

          echo "<br>";
          $arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
          $arr2 = ['a' => 1, 'b' => '2', 'c' => 3]; 
          var_dump($arr1 == $arr2); // true because of loose comparison

          echo "<br>";
          $arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
          $arr2 = ['a' => 1, 'b' => '2', 'c' => 3]; 
          var_dump($arr1 === $arr2); // false because of loose comparison

        ?>
    </body>
</html>