<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            body {margin-left: 20px;}
        </style>
    </head>
    <body>

        <?php

            function headsOrTails() {
                if (mt_rand(0,1) == 0) return "heads";

                return "tails";
            }
            // return true for positive numbers that are prime
            function isPrime ($n)
            {
                if ($n == 1) return false;
                if ($n == 2 || $n == 3) return true;

                // we only need to test until the square root of n
                $maxNumberToTest = sqrt($n);
                
                for ($i=2; $i<=$maxNumberToTest; $i++) {
                    if ($n % $i == 0) return false; // n is divisible by i
                }
                return true;
            }

            function getInterest ($balance, $apr) {
                return $balance * $apr /12 /100;
            }
            
            // get the maximum value of two numbers
            function getMax ($x, $y) {
                if ($x >= $y) return $x;

                return $y;
            }
            echo "<h2>Look at scope</h2>";
            // Difference between global and local variables
            $a = 12; // global variable
            function printNumber () {
                echo "Print the variable a: $a";
            }
            //printNumber(); // THIS CAUSES an ERROR because $a does not exist

            function printGlobalNumber () {
                global $a;
                echo "Print the variable a: $a<br />";
            }
            // this works
            printGlobalNumber();

            function printLocalNumberAndTryToChangeIt() {
                $a = 500;
                echo "Call printLocalNumberAndTryToChangeIt. The variable a: $a<br />";
            }
            printLocalNumberAndTryToChangeIt();
            echo "Outside the function a is still $a. The local number did not change it!<br />";
        ?>
            <h2>Test Heads or Tails</h2>
            <?php
                $headsCount = 0;
                $tailsCount = 0;

                for ($i=0; $i<1000; $i++) {
                    if (headsOrTails() == "heads") $headsCount++; else $tailsCount++;
                }
                echo "Heads Count: $headsCount<br />";
                echo "Tails Count: $tailsCount<br />";
                echo "Heads or tails: " . headsOrTails();
                 
            ?>

            <h2>Test getInterest</h2>
            <p>
                <?php echo "If the balance on my credit card is $1000 and the interest rate is 17.99, I will pay $" . number_format(getInterest(1000, 17.99), 2) . " in interest this month."; ?>
            </p>

            <h2>Text getMax</h2>
            <p>
                <?php echo "The maximum number of 5 and 15 is " . getMax(5, 15); ?>
            </p>
            <h2>First 20 prime numbers</h2>
            <ul>
            <?php 
                $count = 0;
                $i = 0;
                while ($count <= 20):
                    $i++;
                    if (isPrime($i)):
                        $count++;
                        
            ?>
                    <li><?php echo $i; ?></li>
            <?php
                    endif;
                endwhile;
            ?>
            </ul>


            
    </body>
</html>
