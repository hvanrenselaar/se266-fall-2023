<?php
    if (isset($_POST['addAmount'])) {
        $amount = filter_input (INPUT_POST, 'amount');
        $amount += 5;
        //echo $amount;
    } else {
        $amount = 100;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="hidden" name="amount" value="<?= $amount ?>" />
        <input type="submit" name="addAmount" />
    </form>
</body>
</html>