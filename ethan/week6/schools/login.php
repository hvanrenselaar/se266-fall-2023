<?php

    include_once __DIR__ . "/models/model_schools.php";
    include_once __DIR__ . "/includes/functions.php";

    //call session before any html
    session_start();

    //set title var for header
    $title = "Schools Upload";
    require __DIR__ . "/includes/head.php";

    //check username and password
    if (isPostRequest()) {
        $username = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'password');
       
        // your logic here
        $b = checkLogin($username, $password);
        if ($b)
            { 
                $_SESSION['username'] = $username;
                $_SESSION['loggedIn'] = true;
                header('Location: ./upload.php');
             }
        else 
            {
                echo "Not logged in";
                session_destroy();
            }
    
    }
?>
<body>
    <div id="mainDiv" class="w3-margin w3-center">
        <form method="post" action="login.php">
            <div class="rowContainer">
                <h3>Please Login</h3>
            </div>
            <div class="rowContainer">
                <div class="col1">User Name:</div>
                <div class="col2"><input type="text" name="userName" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1">Password:</div>
                <div class="col2"><input type="password" name="password" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
            </div>
            
        </form>
        
    </div>
</body>
