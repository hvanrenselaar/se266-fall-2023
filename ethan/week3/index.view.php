<?php 
function alert($tempBool){
    if ($tempBool) { 
        $newAlert = "<div class='w3-panel w3-red'><h4>Error!</h4><p>Insufficient Funds<p>"; //create new div for alert box. spelling?
        echo $newAlert;
        }
    }
?>
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
            <a href="../week2" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Week 2</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Week 3</a>
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
            <a href="../week2" class="w3-bar-item w3-button w3-padding-large">Week 2</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large">Week 3</a>
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
    <form method="post" action="index.php" class="w3-container">
        <div id="ATM" class = "w3-section" >
            <div class="w3-card w3-padding w3-center w3-light-grey"> 
                <?=$checking->getAccountDetails();?>
                <div class="w3-cell-row w3-section w3-center w3-section">
                    <div class="w3-container w3-cell w3-margin">
                        <input type="digit" name="cWithdrawAmnt" class="w3-input w3-border w3-round"/> 
                        <input type="submit"  value="Withdraw" name="btnCheckingWithdraw" class="w3-button w3-border w3-white w3-margin w3-round"/>
                    </div>
                    <div class="w3-container w3-cell w3-margin">
                        <input type="digit" name="cDepositAmnt" class="w3-input w3-border w3-round"/> 
                        <input type="submit"  value="Deposit" name="btnCheckingDeposit" class="w3-button w3-border w3-white w3-margin w3-round"/>
                    </div>
                </div>
                <input type="hidden"  value='<?=$checking->getBalance();?>' name="checkingBalance">
                <input type="hidden"  value='<?=$checking->getAccountId();?>' name="checkingAccountId">
                <input type="hidden"  value='<?=$checking->getStartDate();?>' name="checkingStartDate">

            </div>    
            <div class="w3-card w3-padding w3-center w3-section w3-light-grey">  
                <?=$savings->getAccountDetails();?>
                <div class="w3-cell-row w3-section w3-center">
                    <div class="w3-container w3-cell w3-padding">
                        <input type="digit" name="sWithdrawAmnt" class="w3-input w3-border w3-round"/> 
                        <input type="submit"  value="Withdraw" name="btnSavingsWithdraw" class="w3-button w3-border w3-white w3-margin w3-round"/>
                    </div>
                    <div class="w3-container w3-cell w3-padding">
                        <input type="digit" name="sDepositAmnt" class="w3-input w3-border w3-round"/> 
                        <input type="submit"  value="Deposit" name="btnSavingsDeposit" class="w3-button w3-border w3-white w3-margin w3-round"/>
                    </div>
                </div>
                <input type="hidden"  value='<?=$savings->getBalance()?>' name="savingsBalance">
                <input type="hidden"  value='<?=$savings->getAccountId()?>' name="savingsAccountId">
                <input type="hidden"  value='<?=$savings->getStartDate()?>' name="savingsStartDate">
            </div>  
        </div>
    </form>
    
</body>
</html>