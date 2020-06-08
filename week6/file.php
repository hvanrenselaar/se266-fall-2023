<?php

// $names = file('names.txt');
// var_dump ($names); // shows an array


// $file = fopen ('names.txt', 'rb');
// while (!feof($file)) {
//    $name = fgets ($file);
//    echo $name . "*** <br />";
// }

if (!file_exists("uploads/schools.csv")) {
   echo "File does not exist";
   exit;
}
$file = fopen ('uploads/schools.csv', 'rb');
$i = 0;
while (!feof($file) && $i<1) {
   
   $school = fgetcsv($file);
   
   echo ($school[1]) . "<br />";
   $i++;
}

?>

