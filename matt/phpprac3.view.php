<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Prac 3</title>
</head>
<body>
    <a href="index.php">Return Home</a>

    <br>
    <br>

    <h3>Task</h1>
    
    <li>
        <strong>Title: </strong> <?=$task['title']; ?>
    </li>

    <li>
        <strong>Due: </strong> <?=$task['due']; ?>
    </li>

    <li>
        <strong>Assigned to: </strong> <?=$task['who']; ?>
    </li>

    <li>
        <strong>Status: </strong> 
        
        <?php
        if($task['complete']) {
            echo '&#9989;';
        }
        else {
            echo '&#10060;';
        }
        ?>
    </li>
    
</body>
</html>