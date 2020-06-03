<?php

$salt = "SECRET";
$str = "hello";

 echo sha1($str) . "<br />";
 echo sha1($salt . $str) . "<br />";
 
 
$str = "Hello";

 echo sha1($str) . "<br />";
 
 ?>

