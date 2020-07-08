<?php

function randomColor(){
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

function randomColorArray($num){
    $colors = array();
    for ($i=0; $i < $num; $i++)
    {
        array_push($colors, randomColor());
    }
}
