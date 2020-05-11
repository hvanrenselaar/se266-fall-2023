<?php
    if (isset($_POST['submitBtn'])) {
        // if (isset($_POST['adult'])) {
        //     echo "You're an adult";
        // } else {
        //     echo "You are NOT an adult";
        // }
        // echo "Form submitted<hr />";
        // $value = filter_input(INPUT_POST, 'val1', FILTER_VALIDATE_FLOAT);
        // if ($value == "") {
        //     echo "You did not submit a number!";
        // }
        // echo $value;
        $state = filter_input (INPUT_POST, 'state');
        echo $state;
        //var_dump ($_POST);
    } else {
        echo "Initial load of form";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Forms</title>
</head>
<body>
    <h1>Demo Forms - ***</h1>
    <form action="demoforms.php" method="post">
        <input type="text" name="val1" value="Whatever" />
        <input type="checkbox" value="Adult" name="adult" checked>Adult<br />
        <input type="radio" value="single" name="status">Single
        <input type="radio" value="relationship" name="status">In a relationship<br />
        <select name="state">
            <option>Rhode Island</option>
            <option>Massachusetts</option>
            <option>Connecticut</option>
            <option>Maine</option>
            <option>New Hampshire</option>
            <option>Vermont</option>
            
        </select>
        
        <input type="submit" name="submitBtn" />
    </form>
</body>
</html>