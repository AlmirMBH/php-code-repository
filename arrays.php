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
        // array_chunk
        $items = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        prettyPrintArray(array_chunk($items, 2));


        // array_combine, array_filter, array_values
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


        // array_keys
        $items2 = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => '1'];
        $keys = array_keys($items2, 1, true); // if true, searches for value and type
        prettyPrintArray($keys);

        $items3 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $mapped1 = array_map(fn($number) => $number * 3, $items3);
        prettyPrintArray($mapped1);


        // array_map
        $items4 = ['a' => 1, 'b' => 2, 'c' => 3];
        $items5 = ['d' => 4, 'e' => 5, 'f' => 1];
        $mapped2 = array_map(fn($number, $number2) => $number * $number2, $items4, $items5);
        prettyPrintArray($mapped2);
        $mapped3 = array_map(null, $items4, $items5); // null instead of callback merges arrays
        prettyPrintArray($mapped3);

        
        // array_reduce
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

        // array_diff
        $num1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $num2 = [3, 4, 5, 4];
        $num3 = [7, 8, 9, 10];
        $arrDiff = array_diff($num1, $num2, $num3); // only vales, not keys
        prettyPrintArray($arrDiff);

        // array_diff_key
        $arrDiff1 = array_diff_key($num1, $num2, $num3); // onlye keys, not values
        prettyPrintArray($arrDiff1);

        // array_diff_assoc
        $arrDiff2 = array_diff_assoc($num1, $num2, $num3); // values and keys
        prettyPrintArray($arrDiff2);

        // usort
        $arrSort = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
        $sorted1 = usort($arrSort, fn($a, $b) => $a <=> $b);
        // prettyPrintArray($sorted1);
        $sorted2 = usort($arrSort, fn($a, $b) => $b <=> $a); // reverse order
        // prettyPrintArray($sorted2);

        // array destruction
        $arrDestruct = [1, 2, [3, 4]];
        
        list($a, $b, $c, $d) = $array; 
        [$a, $b, $c, $d] = $array; // shorter version, the same as above
        echo $a . ", " . $c . " " . $d; // output 1, 3, 4 ($b skipped)

        // nested array destruction
        $arrDestruct1 = [1, 2, [3, 4]];
        [$b, [$c, $d]] = $array; // keys can also be specified e.g. [1 => $b, 2 => [$c, $d]] = $array;
        echo $a . " " . $b . " " . $c . " " . $d; // output 1, 2, 3, 4

        





    ?>
    
</body>
</html>