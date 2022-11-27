<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th style="padding-right: 35px">Date</th>
                <th style="padding-right: 35px">Check #</th>
                <th style="padding-right: 35px">Description</th>
                <th style="padding-right: 35px">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if($transactions): ?>
                <?php foreach($transactions as $transaction): ?>
                    <tr>
                        <td style="padding-right: 35px"><?= formatDate($transaction['date']) ?></td>
                        <td style="padding-right: 35px"><?= $transaction['checkNumber'] ?></td>
                        <td style="padding-right: 35px"><?= $transaction['description'] ?></td>
                        <td style="padding-right: 35px"><?= formatDollarAmount($transaction['amount']) ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
            <tr>
                <td></td>
            </tr>
        </tbody>
        <tfoot style="padding-left:50px">
            <tr>
                <th>Total Income</th>
                <td><?= formatDollarAmount($totals['totalIncome']) ?? 0 ?><td>
            </tr>
            <tr>
                <th>Total Expense</th>
                <td><?= formatDollarAmount($totals['totalExpense']) ?? 0 ?><td>
            </tr>
            <tr>
                <th>Total income</th>
                <td><?= formatDollarAmount($totals['netTotal']) ?? 0 ?><td>
            </tr>
        </tfoot>
    </table>
    
</body>
</html>

