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
        echo '<br>array_chunk<br>';
        $items = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        prettyPrintArray(array_chunk($items, 2));


        echo '<br><br>array_push<br>';
        $items['f'] = 6;
        array_push($items, 7);
        prettyPrintArray(array_chunk($items, 2));


        echo '<br><br>array_pop<br>';
        array_pop($items);
        prettyPrintArray($items);


        echo '<br><br>array_shift<br>'; 
        $items2 = [1, 2, 3, 4, 5, 6, 7];
        array_shift($items); // after removing the first element, reindexing occurs
        array_shift($items2); // after removing the first element, key reindexing does not occur
        unset($items2[3]);
        $items2[] = 8;
        prettyPrintArray($items2);
        prettyPrintArray($items);


        echo '<br><br>key exists<br>';
        $items3 = ['a' => 1, 'b' => null];
        var_dump(array_key_exists('b', $items3));
        echo "<br>";
        var_dump(isset($items3['b']));
        echo "<br>";


        echo '<br><br>associative array keys<br>';
        $arr = [true =>'a', 1 => 'b', 1 =>'c', 1.8 => 'd', null => 'e']; // overriding will occur: 1 => d
        prettyPrintArray($arr);
        echo $arr[null], "<br>";
        $arr2 = ['a', 'b', 50 => 'c', 'd', 'e']; // 0 => 1, 2 => b, 50 => c, 51 => d, 52 => e
        prettyPrintArray($arr2);


        echo '<br><br>array_combine, array_filter, array_values<br>';
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
        $arr4 = array_filter($array4);        
        prettyPrintArray($arr4);


        echo '<br><br>array_keys<br>';
        $items2 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => '1'];
        $keys = array_keys($items2, 1, true); // if true, searches for value and type
        prettyPrintArray($keys);

        $items3 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $mapped1 = array_map(fn($number) => $number * 3, $items3);
        prettyPrintArray($mapped1);


        echo '<br><br>array_map<br>';
        $items4 = ['a' => 1, 'b' => 2, 'c' => 3];
        $items5 = ['d' => 4, 'e' => 5, 'f' => 1];
        $mapped2 = array_map(fn($number, $number2) => $number * $number2, $items4, $items5);
        prettyPrintArray($mapped2);
        $mapped3 = array_map(null, $items4, $items5); // null instead of callback merges arrays
        prettyPrintArray($mapped3);

        
        echo '<br><br>array_reduce<br>';
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


        echo '<br><br>array_diff<br>';
        $num1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $num2 = [3, 4, 5, 4];
        $num3 = [7, 8, 9, 10];
        $arrDiff = array_diff($num1, $num2, $num3); // only vales, not keys
        prettyPrintArray($arrDiff);


        echo '<br><br>array_diff_key<br>';
        $arrDiff1 = array_diff_key($num1, $num2, $num3); // onlye keys, not values
        prettyPrintArray($arrDiff1);


        echo '<br><br>array_diff_assoc<br>';
        $arrDiff2 = array_diff_assoc($num1, $num2, $num3); // values and keys
        prettyPrintArray($arrDiff2);


        echo '<br><br>usort<br>';
        $arrSort = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
        $sorted1 = usort($arrSort, fn($a, $b) => $a <=> $b);
        // prettyPrintArray($sorted1);
        $sorted2 = usort($arrSort, fn($a, $b) => $b <=> $a); // reverse order
        // prettyPrintArray($sorted2);


        echo '<br><br>array destruction<br>';
        $arrDestruct = [1, 2, [3, 4]];
        
        list($a, $b, $c, $d) = $array; 
        [$a, $b, $c, $d] = $array; // shorter version, the same as above
        echo $a . ", " . $c . " " . $d; // output 1, 3, 4 ($b skipped)


        echo '<br><br>nested array destruction<br>';
        $arrDestruct1 = [1, 2, [3, 4]];
        [$b, [$c, $d]] = $array; // keys can also be specified e.g. [1 => $b, 2 => [$c, $d]] = $array;
        echo $a . " " . $b . " " . $c . " " . $d; // output 1, 2, 3, 4

        





    ?>
    
</body>
</html>