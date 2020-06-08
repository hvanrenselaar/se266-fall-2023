<?php

// '5ece240085b9ad85b64896082e3761c54ef581de'
$salt = "SECRET";
$str = "Duck";

 echo sha1($str) . "<br />";

echo sha1($salt . $str) . "<br />";
 
 

 
 ?>

