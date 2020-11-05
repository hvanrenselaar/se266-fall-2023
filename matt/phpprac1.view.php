<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Prac 1</title>
</head>
<body>
    <a href="index.php">Return Home</a>

    <br>
    <br>

    <?php
        foreach ($animals as $animal) {
            echo "<li>$animal</li>";
        }
    ?>
</body>
</html>