<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditional statements</title>
</head>
<body>
    
    <?php $score = 95 ?>

    <?php if ($score >= 90): ?>
        <strong style="color:green">A</strong>
    <?php elseif ($score >= 80): ?>
        <strong style="color:red">B</strong>
    <?php else: ?>
        <strong>C</strong>        
    <?php endif ?>


</body>
</html>

