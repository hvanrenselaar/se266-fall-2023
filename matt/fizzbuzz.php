<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FizzBuzz</title>
</head>
<body>
    <a href="index.php">Return Home</a>
    <br>
    <br>
    <?php
    
        function fizzBuzz($num){
            if($num % 2 == 0 and $num % 3 == 0){
                return 'FizzBuzz';
            }

            elseif($num % 2 == 0){
                return 'Fizz';
            }

            elseif($num % 3 == 0){
                return 'Buzz';
            }

            else{
                return $num;
            }
        }

        for ($i=1; $i<=100; $i++){
            echo fizzBuzz($i);
            echo '<br>';
        }
        ?>
</body>
</html>