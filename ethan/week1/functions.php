<?php
function dd($value){
        die(var_dump($value));
    }

function drinkingAge($person){
    if ($person['age'] >= 21)
    {
        echo ' &#9989' . $person['name'] . ' is old enough to drink';
    }
    else
    {
        echo $person['name'] . ' is not old enough to drink';
    }
function fizzBuzz($number)
{
    if($number % 3 == 0 && $number % 2 ==0){
        return "Fizz Buzz";
    }
    else if($number % 2 == 0){
        return "Fizz";
    }
    else if($number % 3 == 0){
        return "Buzz";
    }
    else {
        return $number;
    }
}

}