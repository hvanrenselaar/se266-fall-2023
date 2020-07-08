<?php

function CreateAlert($message){
    echo "<div class='alert alert-danger' role='alert'>" . $message . "</div>";
}
//all this does is if value is null, return 'null' instead, SQL cant understand null and needs the quotes
function SqlReady($value){
    return ($value != "") ? "'" . $value . "'" : 'NULL';
}