<?php

//$names = file('names.txt');
//print_r ($names); // shows an array

/*
$file = fopen ('names.txt', 'rb');
while (!feof($file)) {
   $name = fgets ($file);
   echo $name . "*** <br />";
}
*/

$file = fopen ('uploads/schools.csv', 'rb');
$i = 0;
while (!feof($file) && $i<10) {
   $school = fgetcsv($file);
   echo ($school[1]) . "<br />";
   $i++;
}

?>

