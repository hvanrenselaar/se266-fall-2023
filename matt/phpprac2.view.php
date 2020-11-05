<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Prac 2</title>
</head>
<body>
    <a href="index.php">Return Home</a>

    <br>
    <br>

    <h3>Task</h1>
    <?php
        foreach ($task as $label => $value) {
            echo "<li><strong>$label:</strong> $value</li>";
        }
    ?>
</body>
</html>