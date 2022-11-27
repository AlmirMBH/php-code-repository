<?php
declare(strict_types = 1);


function getTransactionFiles($dirPath): array {     

    $files = [];

    foreach(scandir($dirPath) as $file){
        if(is_dir($file)){
            continue;
        }
        $files[] = $dirPath . $file;
    }

    return $files;
}


/**
 * Callable as parameter is used for handling files containing data formatted in different ways.
 * Although passed as a string, the name of the handler must match the actual method name - extractTransaction.
 */ 
function getTransactions(string $fileName, ?callable $transactionHandler = null): array {
    if(! file_exists($fileName)){
        trigger_error("File $fileName does not exist.", E_USER_ERROR);
    }

    $file = fopen($fileName, "r");
    fgetcsv($file); // get header in order to get only contents in the while loop below
    $transactions = [];

    while(($transaction = fgetcsv($file)) !== false){
        if($transactionHandler === 'extractTransaction'){
            $transactions[] = extractTransaction($transaction);
        }
    }

    return $transactions;
}


function extractTransaction(array $transactionRow): array{
    // destructure array instead of using indexes e.g. $transactionRow[2]
    [$date, $checkNumber, $description, $amount] = $transactionRow;
    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
    ];
}



function calculateTotals(array $transations): array{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach($transations as $transaction){
        $totals['netTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0){
             $totals['totalIncome'] += $transaction['amount'];   
        }else{
            $totals['totalExpense'] += $transaction['amount'];   
        }
    }

    return $totals;
}