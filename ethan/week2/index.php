<?php
    //declaring variables
    $firstName = null;
    $lastName = null;
    $feet = "";
    $inches = "";
    $weight = "";
    $married = "";
    $pass = false;
    $error = array();
    

    //copy function to determine age
    function age ($bdate) {
        $date = new DateTime($bdate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;

    }
    //function to return bmi
    function bmi ($ft, $inch, $lbs) {

        //weight to kg
        $kg = ($lbs * 0.453592);

        //height to meters. using inches cause easier
        $heightInInches = $ft * 12 + $inch;
        $meters = 0.0254 * $heightInInches;

        //bmi function
        return round(($kg / ($meters * $meters)), 2);
    }
     function bmiDescription ($bmi) {

        if ($bmi < 18.5) {return "underweight";}
        else if (18.5 <= $bmi && $bmi <= 24.9) {return "normal weight";}
        else if (25 <= $bmi && $bmi <= 30) {return "over weight";}
        else {return "obese";}
    }
    //copy function to validate date
    function isDate($dt) {

        try {

            $d = new DateTime($dt);
            $today = new DateTime();
            //check if day in future
            if ($d < $today){
                 return (true);
            }
            else 
            {
                return false;
            }

        } catch(Exception $e) {

            return false;

        }
    }
    //function for to create alert
    function alert($error_array){
        if (Count($error_array) > 0) { 
            $newAlert = "<div class='w3-panel w3-red'><h4>Error!</h4>"; //create new div for alert box
            
            foreach ($error_array as $error_entry)
            {
                $newAlert .= "<p> $error_entry <p/>";
            }

            $newAlert .= "</div>";
            echo $newAlert;
            }
        }
    //if button pushed
    if (isset($_POST['btnSubmit'])) {

        //reseting error with each submit
        $error = array();

        //all values but married
        $firstName = filter_input(INPUT_POST, 'firstName'); 
        $lastName = filter_input(INPUT_POST, 'lastName'); 
        $birthDay = filter_input(INPUT_POST, 'bday');
        $feet = filter_input(INPUT_POST, 'feet', FILTER_VALIDATE_INT);
        $inches = filter_input(INPUT_POST, 'inches', FILTER_VALIDATE_INT);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);

        //if bd is set messing around with this
        if ($birthDay == null) 
        {
            array_push($error, "Birthdate cannot be blank");
        }
        else  {
            if (!IsDate($birthDay)){
                array_push($error, "Birthdate must be a valid date");
            }
        }

        //if statments to validate. Whill check error message later to see if we should run or not
        if (strlen($firstName) == 1) {
            array_push($error, "No first name provided");
        }
        if (strlen($firstName) == 1) {
            array_push($error, "No last name provided");
        }
        if ($inches == "") { 
            array_push($error,"Inches cannot be blank");
        }
        if ($feet == "") {
            array_push($error,"Feet cannot be blank");
        }
        if ($weight == "") {
            array_push($error, "Weight cannot be blank");
        }
        //check if married 
        if (!isset($_POST['married'])){
            array_push($error, "Must select if married or not");
        }
        else {
            $married = $_POST["married"];
        }
        if (Count($error) == 0)
        {   
            $pass = true;
        }
    }
    require "index.view.php";

