<?php
$str = "Brady";
echo sha1($str) . "<br />";

echo "74d9e4fc4b49c8b3ac8ef864bb229d41ac3244c7";
exit;
$salt = "SECRET";


echo sha1($salt . $str) . "<br />";
 
 

 
 ?>

