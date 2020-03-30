<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            /*
             * Some functions to learn.  Learn more about them on PHP.net
             * 
             * strtoupper
             * var_dump
             * isset
             */
            $str = 'hello';            
            echo strtoupper($str);
            $a = ['1', '2', '3'];
                    
            $randColor = '#'.strtoupper(dechex(rand(0x000000, 0xFFFFFF)));

            echo $randColor;    
            exit;
            var_dump($a);
            print_r ($a);
             //replace this code to echo out the randColor in place of [color]
             //using SoC             
           ?>
        
          <?php  if ( isset($randColor) ) { ?>
              <span style="background-color:<?php echo $randColor; ?>">
                  
                  [<?php echo $randColor; ?>]
              
              </span>  
           <?php } ?>

    </body>
</html>
