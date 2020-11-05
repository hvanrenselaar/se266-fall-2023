<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Prac 4</title>
</head>
<body>
    <a href="index.php">Return Home</a>

    <br>
    <br>
    <p><strong>'if(ageCheck(25))'</strong>
    <br>
    <?php
    if(ageCheck(25)){
        echo 'You may enter';
    }
    else{
        echo 'You are not old enough';
    }
    ?>

    <p><strong>'if(ageCheck(16))'</strong>
    <br>
    <?php
    if(ageCheck(16)){
        echo 'You may enter';
    }
    else{
        echo 'You are not old enough';
    }
    ?>
</body>
</html>