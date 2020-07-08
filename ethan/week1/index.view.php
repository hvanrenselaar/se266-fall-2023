<!DOCTYPE html>
<html lang="en">
<title>SE266 Week 1 Array</title>
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
            <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Week 1</a>
            <a href="../week2" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 2</a>
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
            <a href="#" class="w3-bar-item w3-button w3-padding-large">Week 1</a>
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
    <div id="animal-array" class="w3-card w3-margin w3-light-grey">
        <h3 class='w3-center'> Animal Array </h3>
        <ul>
        <?php foreach ($animals as $animal) : ?>
            <li><?= $animal ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div id="associative-array" class="w3-card w3-margin w3-light-grey">
        <h3 class='w3-center'> Associative Array</h3>
        <ul>
        <?php foreach ($person as $feature => $val) : ?>
            <li><strong><?= ucwords($feature); ?>: </strong><?= $val; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div id="task-array" class="w3-card w3-margin w3-light-grey">
        <h3 class='w3-center'> Task Array</h1>
        <ul>
            <li>
                <strong>Assignment: </strong> <?= $task['title']; ?>
            </li>
            <li>
                <strong>Due Date: </strong> <?= $task['due']; ?>
            </li>
            <li>
                <strong>Assigned To: </strong> <?= $task['assigned-to']; ?>
            </li>
            <li>
                <strong>Status: </strong> 
                <?php if ($task['completed']) : ?>
                    &#9989
                <?php endif; ?>
                <?php if (!$task['completed']) : ?>
                    Incomplete
                <?php endif; ?>
            </li>
        </ul>
    </div>
    <div id="functions" class="w3-card w3-margin w3-light-grey">
        <h3 class='w3-center'> Check Age Function </h3>
        <p class = 'w3-margin'>  
            <?= drinkingAge($person); ?>
        </p>
    </div>
    <div id="fizzbuzz" class="w3-card w3-margin w3-light-grey">
        <h3 class='w3-center'> Fizz Buzz</h3>
        <ul>  
            <?php for ($i = 1; $i <= 100; $i++) : ?>
                <li> <?= fizzbuzz($i); ?> </li>
            <?php endfor; ?>
        </ul>
    </div>
</body>
</html>