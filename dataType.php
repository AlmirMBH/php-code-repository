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
           * Integers
           */
          echo PHP_INT_MIN . "<br>";
          echo PHP_INT_MAX . "<br>";
          echo PHP_INT_SIZE . "<br>";

          var_dump(PHP_INT_MAX);
          echo "<br>";
          echo 200_000_000 . "<br>"; // underscore can be used to improve code readability
          var_dump(PHP_INT_MAX + 1); // auto-casting to float
          echo "<br>";
          

          /**
           * Floats
           */
          $a = 13.5e3; // exponential form
          echo $a . "<br>";
          $b = 13.5e-3; // exponential form negative
          echo $b . "<br>";
          echo PHP_FLOAT_MIN . "<br>";
          echo PHP_FLOAT_MAX . "<br>";
          
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
          $name = "Will Smith";
          $name[2] = 'P';
          $name[44] = 'G';
          echo $name[-2] . "<br>"; // t
          echo $name . "<br>";

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
          


        ?>
    </body>
</html>