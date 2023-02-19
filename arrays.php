<!DOCTYPE html>
<html lang="en">
<head><title>Arrays</title>
</head>
<body>
    <h1>Arrays</h1>

    <?php

function prettyPrintArray($array){
    echo "<pre>";
        print_r($array);
    echo "</pre>";
}
        echo '<br>ARRAY CHUNK WITH AND WITHOUT PRESERVED KEYS<br>';
        $items = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        prettyPrintArray(array_chunk($items, 3));
        prettyPrintArray(array_chunk($items, 3, true));


        echo '<br><br>ARRAY PUSH<br>';
        $items['f'] = 6;
        array_push($items, 7);
        prettyPrintArray(array_chunk($items, 2));


        echo '<br><br>ARRAY POP<br>';
        array_pop($items);
        prettyPrintArray($items);


        echo '<br><br>ARRAY SHIFT<br>'; 
        $items2 = [1, 2, 3, 4, 5, 6, 7];
        array_shift($items); // after removing the first element, reindexing occurs
        array_shift($items2); // after removing the first element, key reindexing does not occur
        unset($items2[3]);
        $items2[] = 8;
        prettyPrintArray($items2);
        prettyPrintArray($items);


        echo '<br><br>ARRAY KEY EXISTS<br>';
        $items3 = ['a' => 1, 'b' => null];
        var_dump(array_key_exists('b', $items3));
        echo "<br>";
        var_dump(isset($items3['b']));
        echo "<br>";


        echo '<br><br>ASSOCIATIVE ARRAY KEYS<br>';
        $arr = [true =>'a', 1 => 'b', 1 =>'c', 1.8 => 'd', null => 'e']; // overriding will occur: 1 => d
        prettyPrintArray($arr);
        echo $arr[null], "<br>";
        $arr2 = ['a', 'b', 50 => 'c', 'd', 'e']; // 0 => 1, 2 => b, 50 => c, 51 => d, 52 => e
        prettyPrintArray($arr2);


        echo '<br><br>ARRAY COMBINE, ARRAY FILTER, ARRAY VALUES<br>';
        $array1 = ['a', 'b', 'c', 'd'];
        $array2 = [1, 2, 3, 4];
        prettyPrintArray(array_combine($array1, $array2)); //keys, values; size must match
        $even1 = array_filter($array2, fn($number) => $number % 2 === 0);
        prettyPrintArray($even1);

        $array3 = [1, 2, 3, 4, 5, 0, 7, 8, 9, 10];
        $arr1 = array_filter($array3, fn($number) => $number % 2 === 0, ARRAY_FILTER_USE_KEY);        
        prettyPrintArray($arr1);        
        $arr2 = array_filter($array3, fn($number, $key) => $number % 2 === 0, ARRAY_FILTER_USE_BOTH);        
        $arr3 = array_values($arr2); // numerical indexing
        prettyPrintArray($arr3);
        
        $array4 = [1, 2, 3, [], 5, 0, 7, false, 9, 0.0];
        prettyPrintArray($array4);
        $arr4 = array_filter($array4); // filter false values from the array       
        prettyPrintArray($arr4);


        echo '<br><br>ARRAY KEYS<br>';
        $items2 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => '1'];
        $keys = array_keys($items2, 5); // key of the element with value of 10 (loose comparison)
        $keys2 = array_keys($items2, '5', true); // key of the element with value of 10 (strict comparison)
        $keys3 = array_keys($items2, 1, true); // if true, searches for value and type
        prettyPrintArray($keys);
        prettyPrintArray($keys2);
        prettyPrintArray($keys3);

        
        echo '<br><br>ARRAY MAP<br>';
        $items3 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $mapped1 = array_map(fn($number) => $number * 3, $items3);
        prettyPrintArray($mapped1);

        $items4 = ['a' => 1, 'b' => 2, 'c' => 3];
        $items5 = ['d' => 4, 'e' => 5, 'f' => 1];
        $mapped2 = array_map(fn($number, $number2) => $number * $number2, $items4, $items5);
        prettyPrintArray($mapped2);

        $mapped3 = array_map(null, $items4, $items5); // null instead of callback merges arrays
        prettyPrintArray($mapped3);


        echo '<br><br>ARRAY MERGE<br>';
        $items6 = [1, 2, 3];
        $items7 = [4, 5, 6];
        $items8 = [7, 8, 9];
        $merged = array_merge($items6, $items7, $items8);
        prettyPrintArray($merged);
        

        echo '<br><br>ARRAY REDUCE<br>';
        $invoiceItems = [
            ['price' => 9.99, 'qty' => 3, 'desc' => 'Item1'],
            ['price' => 19.99, 'qty' => 1, 'desc' => 'Item2'],
            ['price' => 9.14, 'qty' => 1, 'desc' => 'Item3'],
            ['price' => 10.99, 'qty' => 1, 'desc' => 'Item4'],
            ['price' => 4.55, 'qty' => 2, 'desc' => 'Item5'],
        ];

        $total = array_reduce($invoiceItems, fn($sum, $item) => $sum + $item['qty'] * $item['price']);
        prettyPrintArray($total);

        // add to 300 (initial value)
        $initialValue = 300;
        $total1 = array_reduce($invoiceItems, fn($sum, $item) => $sum + $item['qty'] * $item['price'], $initialValue);
        prettyPrintArray($total1);


        echo '<br><br>ARRAY SEARCH<br>';
        $items9 = ['a', 'b', 'c', 'd', 'e', 'f'];
        $search = array_search('d', $items9); // searches for the first value and it is case sensitive
        prettyPrintArray($search);


        echo '<br><br>ARRAY_DIFF<br>';
        $num1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $num2 = [3, 4, 5, 4];
        $num3 = [7, 8, 9, 10];
        $arrDiff = array_diff($num1, $num2, $num3); // only values compared, not keys
        prettyPrintArray($arrDiff);


        echo '<br><br>ARRAY_DIFF_KEY<br>';
        $arrDiff1 = array_diff_key($num1, $num2, $num3); // onlye keys compared, not values
        prettyPrintArray($arrDiff1);


        echo '<br><br>ARRAY_DIFF_ASSOC<br>';
        $arrDiff2 = array_diff_assoc($num1, $num2, $num3); // key-value pair compared
        prettyPrintArray($arrDiff2);


        echo '<br><br>ASORT<br>';
        $arrSort = ['d' => 3, 'b' => 2, 'c' => 1, 'a' => 4]; // sort by value
        prettyPrintArray($arrSort);
        asort($arrSort);
        prettyPrintArray($arrSort);


        echo '<br><br>KSORT<br>';
        $arrSort2 = ['d' => 3, 'b' => 2, 'c' => 1, 'a' => 4]; // sort by keys
        prettyPrintArray($arrSort2);
        ksort($arrSort2);
        prettyPrintArray($arrSort2);
        


        echo '<br><br>USORT<br>';
        $arrSort3 = ['a' => 2, 'b' => 3, 'c' => 4, 'd' => 1];
        prettyPrintArray($arrSort3);
        usort($arrSort3, fn($a, $b) => $a <=> $b); // ascending order, keys removed
        prettyPrintArray($arrSort3);
        usort($arrSort3, fn($a, $b) => $b <=> $a); // reverse order, keys removed
        prettyPrintArray($arrSort3);


        echo '<br><br>(NESTED) ARRAY DESTRUCTION<br>';
        $array1 = [1, [3, 4], 2, 5, 6];
        [$a, , $c, , $e] = $array1;
        echo $a , ", " , $c , " ", $e, "<br>"; // output 1, 2 ([3, 4] skipped)


        $array2 = [1, [3, 4], 2];
        [$a, [$b, $c], $d] = $array2;
        echo $a , ", " , $b , " ", $c , " ", $d, "<br>"; // output 1, 3, 4, 2 (with nested array)
        
        $array3 = [5, 6, 7, 8];
        list($e, $f, $g, $h) = $array3; 
        echo $e . ", " . $f . " " . $g, " ", $h, "<br>"; // output 1, 3, 4 ($b skipped)


        echo '<br><br>ARRAY DESTRUCTION WITH KEYS<br>';
        $array4 = [1, 2, 3, 4];
        [1 => $b, 3 => $d, 0 => $c, 2 => $a] = $array4; // array4 key => array4 value e.g. (2 => $a) == (2 => 3)
        echo $c . " " . $d . " " . $b . " " . $a, "<br>"; // output 3, 2, 1
        

        





    ?>
    
</body>
</html>