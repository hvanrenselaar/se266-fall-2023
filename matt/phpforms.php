<?php

function ageCalc ($bdate) {

    $date = new DateTime($bdate);

    $now = new DateTime();

    $interval = $now->diff($date);



    return $interval->y;

}

function isDate($dt) {

    try {

        $d = new DateTime($dt);

        return (true);

    } catch(Exception $e) {

        return false;

    }

}

function bmiCalc ($ft, $inch, $wt) {

    //Convert weight to kg
    $weightKg = ($wt / 2.20462);

    //Convert height into meters
    $meters = (($ft * 12) * 0.0254);
    $meters += ($inch * 0.0254);

    //Square the value
    $meters = ($meters * $meters);

    $result = ($weightKg / $meters);

    //Round result and return BMI
    return number_format($result, 1);
}

function bmiClassCalc($bmi){
    if ($bmi < 18.5)
    {
        $result = "Underweight";
    }
    else if ($bmi >= 18.5 && $bmi < 25)
    {
        $result = "Normal weight";
    }
    else if ($bmi >= 25.0 && $bmi < 30)
    {
        $result = "Overweight";
    }
    else 
    {
        $result = "Obese";
    }

    return $result;
}

if (isset($_POST['submitBtn']))
{
    
    //This allows us to remove all echos and display the confirmation page cleanly
    ob_start();
    //Alert that the submit was successful
    echo "Submit successful<hr />";
    //filter_input all of the form
    $fName = filter_input(INPUT_POST, 'txtfName');
    $lName = filter_input(INPUT_POST, 'txtlName');
    $marStatus = filter_input(INPUT_POST, 'marital_status');
    $bDay = filter_input(INPUT_POST, 'bDay');
    $age = ageCalc($bDay);
    $heightFt = filter_input(INPUT_POST, 'ft');
    $heightInches = filter_input(INPUT_POST, 'inches');
    $weight = filter_input(INPUT_POST, 'weight');
    $bmi = bmiCalc($heightFt, $heightInches, $weight);
    $bmiClass = bmiClassCalc($bmi);

    //Use valid as a counter of each valid form field
    //If every field is valid, this will allow us to display a confirmation page
    $valid = 0;

    //Check name fields
    if ($fName == "" || $lName == "")
    {
        echo "Please enter a valid name<br>";
    }
    else
    {
        $valid += 1;
        echo "Name validated<br>";
    }

    //Check marital status
    if ($marStatus == "")
    {
        echo "Please enter your marital status<br>";
    }
    else
    {
        $valid += 1;
        echo "Marital status validated<br>";
    }

    //Check date of birth
    if (!isDate($bDay))
    {
        echo "Please enter a valid date of birth<br>";
    }
    else
    {
        $valid += 1;
        echo "Birthday validated<br>";
    }

    //Check height
    if ($heightFt == "" || $heightInches == "")
    {
        echo "Please enter your height<br>";
    }
    else if ($heightInches > 12 || $heightFt < 0 || $heightInches < 0)
    {
        echo "Please enter a valid height<br>";
    }
    else
    {
        $valid += 1;
        echo "Height validated<br>";
    }

    //Check weight
    if ($weight < 0 || $weight == "")
    {
        echo "Please enter a valid weight<br>";
    }
    else
    {
        $valid += 1;
        echo "Weight validated";
    }

    //echo $valid;

    //If all fields are validated:
    if ($valid == 5)
    {
        //Clear the previous echos
        ob_end_clean();
        //Display confirmation
        echo "All fields validated, printing confirmation:<br>";
        echo "<b>Full Name</b>: $fName $lName<br>";
        echo "<b>Marital Status</b>: $marStatus<br>";
        echo "<b>Birthdate</b>: $bDay<br>";
        echo "<b>Age</b>: $age<br>";
        echo "<b>Height</b>: $heightFt Ft $heightInches inches<br>";
        echo "<b>Weight</b>: $weight lbs<br>";
        echo "<b>BMI</b>: $bmi <br>";
        echo "<b>BMI Classification</b>: $bmiClass<br>";
        echo "<hr>";
    }
    //var_dump ($_POST);
}
else 
{
    echo "Initial load of form";
    echo "<hr>";
    $fName = "";
    $lName = "";
    $marStatus = "";
    $conditions = "";
    $bDay = "";
    $heightFt = "";
    $heightInches = "";
    $weight = "";
}
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Return Home</a>
    <br>
    <br>
    <br>
    <h1>Patient Intake Form</h1>
    <form action="phpforms.php" method="post">
    <div class="wrapper">
        <div>
            <b>First Name</b>:<input type="text" name="txtfName" value="<?= $fName; ?>"/>
        </div>
        <br>
        <div>
            <b>Last Name</b>: <input type="text" name="txtlName" value="<?= $lName; ?>"/>
        </div>
        <br>
        <div>
            <b>Marital Status:</b>
            <input type="radio" name="marital_status" value="Married" <?php if(isset($_POST['marital_status']) && $_POST['marital_status'] == 'Married')  echo 'checked="checked"';?>/> Married
            <input type="radio" name="marital_status" value="Unmarried" <?php if(isset($_POST['marital_status']) && $_POST['marital_status'] == 'Unmarried')  echo 'checked="checked"';?>/> Unmarried
        </div>
        <br>
        <div>
            <b>Date of Birth:</b>
            <input type="date" name="bDay"  value="<?= $bDay; ?>"/>
        </div>
        <br>
        <div>
            <b>Height:</b>
            Feet: <input type="text" name="ft"  value="<?= $heightFt; ?>" style="width:40px;">
            Inches: <input type="text" name="inches"  value="<?= $heightInches; ?>" style="width:40px;">
        </div>
        <br>
        <div>
            <b>Weight:</b>
            <input type="text" name="weight"  value="<?= $weight; ?>" style="width:40px;">
        </div>
        <br>
        <input type="submit" name="submitBtn"/>

        <!--<input type="text" name="txtLName"/>-->
    </div>
    </form>
    
</body>
</html>