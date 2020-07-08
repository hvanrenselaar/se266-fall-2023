<!DOCTYPE html>
<html lang="en">
<title>SE266 Week 2 Forms</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>
    <!-- Header -->
    <header class="w3-container">
        <div class="w3-light-grey w3-XLarge w3-margin">
            <h3 class="w3-third w3-center">SE266 </h3>
            <h1 class="w3-third w3-center">Ethan Markham</h1>
            <h3 class="w3-third w3-center">Spring 2020</h3>
        </div>
    </header>
    <div class="w3-nav w3-margin">
        <div class="w3-bar w3-grey w3-card w3-center">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href=".." class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Home</a>
            <a href="../week1" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 1</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Week 2</a>
            <a href="../week3" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 3</a>
            <a href="../week4" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 4</a>
            <a href="../week5" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 5</a>
            <a href="../week6" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 6</a>
            <a href="../week7" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 7</a>
            <a href="../week8" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 8</a>
            <a href="../week9" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 9</a>
            <a href="/week10" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 10</a>
            <a href="https://github.com/EthanMarkham/SE266" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">GIT Repo</a>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href=".." class="w3-bar-item w3-button w3-padding-large">Home</a>
            <a href="../week1" class="w3-bar-item w3-button w3-padding-large">Week 1</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large">Week 2</a>
            <a href="../week2" class="w3-bar-item w3-button w3-padding-large">Week 2</a>
            <a href="../week3" class="w3-bar-item w3-button w3-padding-large">Week 3</a>
            <a href="../week4" class="w3-bar-item w3-button w3-padding-large">Week 4</a>
            <a href="../week5" class="w3-bar-item w3-button w3-padding-large">Week 5</a>
            <a href="../week6" class="w3-bar-item w3-button w3-padding-large">Week 6</a>
            <a href="../week7" class="w3-bar-item w3-button w3-padding-large">Week 7</a>
            <a href="../week8" class="w3-bar-item w3-button w3-padding-large">Week 8</a>
            <a href="../week9" class="w3-bar-item w3-button w3-padding-large">Week 9</a>
            <a href="../week10" class="w3-bar-item w3-button w3-padding-large">Week 10</a>
            <a href="https://github.com/EthanMarkham/SE266" class="w3-bar-item w3-button w3-padding-large">GIT Repo</a>
        </div>
    </div>
    <div id="patientForm" style="display: <?= ($pass ? "none" : "inline") ?> ">
        <form method="post" action="index.php" class="w3-container w3-card-4 w3-margin w3-light-grey">
            <h2 class="w3-text-black w3-center" style="text-shadow:0.5px 0.5px 0 #fff"> Patient Info </h2>
            <?php alert($error) ?>
            <p>
                <label>First Name:</label>
                <input type="text" value="<?= $firstName ?> " name="firstName"class="w3-input w3-border w3-round" />
            </p>
            <p>
                <label>Last Name:</label>
                <input type="text" value="<?= $lastName ?> " name="lastName" class="w3-input w3-border w3-round" />
            </p>
            <p>
                    <label>Married:</label> </br>
                    <input type="radio" value="Married" name="married" class="w3-radio w3-margin-left" <?php if ($married == 'Married') echo 'checked'; ?> /><label> Yes</label>
                    <input type="radio" value="Unmarried" name="married" class="w3-radio w3-margin-left" <?php if ($married == 'Unmarried') echo 'checked'; ?>  /><label> No</label>
            </p>
            <p>
                <label>Birth Date:</label>
                <p><input type="date" value="<?= date('Y-m-d', strtotime($birthDay)); ?>" name="bday" class="w3-input w3-border w3-round" /></p>
            </p>
            <p>
                <label>Height: </label> </br>
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <input type="digit" value="<?= $feet ?>" name="feet" class="w3-input w3-border w3-round" placeholder="Feet" />
                    </div>
                    <div class="w3-half">
                        <input type="digit" value="<?= $inches ?>" name="inches" class="w3-input w3-border w3-round" placeholder="Inches" />
                    </div>
                </div>
            </p>
            <p>
                <label>Weight:</label>
                <input type="digit" value=" <?= $weight ?> " name="weight" class="w3-input w3-border w3-round"  placeholder="Lbs" /> 
            </p>
            <p>
                <input type="submit" value="Check this Form" name="btnSubmit" class="w3-button w3-block w3-border w3-white w3-center" />
            </p>
        </form>
    </div>
    <div id="patientResults" style="display: <?= ($pass ? "inline" : "none") ?> ">
        <form method="post" action="forms.php" class="w3-container w3-card-4 w3-margin w3-light-grey">
            <h2 class="w3-text-black w3-center" style="text-shadow:0.5px 0.5px 0 #fff"> Patient Results </h2>
            <dl>
                <p>
                    <dt>Name: </dt>
                    <dd> <?= "$firstName $lastName" ?> </dd>
                </p>
                <p>
                    <dt> <?= $married ?> </dd> 
                </p>
                <p>
                    <dt>Birth Date:</dt> 
                    <dd><?= $birthDay ?></dd>
                    <dt>Age:</dt>
                    <dd><?= age($birthDay) ?></dd>
                </p>
                <p>
                    <dt>Height:</dt>
                    <dd><?= "$feet ft. $inches inches" ?> </dd>
                    <dt>Weight:</dt>
                    <dd><?= $weight ?> </dd>
                </p>
                <p>
                    <dt>BMI:</dt>
                    <dd><?= bmi($feet, $inches, $weight) ?></dd>
                    <dd><?= bmiDescription(bmi($feet, $inches, $weight)) ?></dd>
                <p>
            </dl>
        </form>
    </div>
</body>
</html>