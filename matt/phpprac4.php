<?php


function ageCheck($age) {
    if($age >= 21){
        return true;
    }
    else {
        return false;
    }
}


require 'phpprac4.view.php';
?>
