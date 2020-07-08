<?php
    require 'account.php';
    $savingsWithdrawal = "";
    $checkingWithdrawal = "";
    //get new checking info
    if (isset($_POST['checkingAccountId'])) {
        $checkID = filter_input(INPUT_POST, 'checkingAccountId'); 
        $checkBalance = filter_input(INPUT_POST, 'checkingBalance', FILTER_VALIDATE_FLOAT); 
        $checkStartDate = filter_input(INPUT_POST, 'checkingStartDate'); 
        
        //get new saving info
        $savID = filter_input(INPUT_POST, 'savingsAccountId'); 
        $savBal = filter_input(INPUT_POST, 'savingsBalance', FILTER_VALIDATE_FLOAT); 
        $savDate = filter_input(INPUT_POST, 'savingsStartDate');
    }
    else {
        //init
        $checkID = 'C123'; 
        $checkBalance = 1000; 
        $checkStartDate = '12-20-2010'; 
        $savID = 'S123'; 
        $savBal = 5000; 
        $savDate = '03-20-2020';
    }
    $checking = new CheckingAccount ($checkID, $checkBalance, $checkStartDate);
    $savings = new SavingsAccount( $savID, $savBal, $savDate);    

    if (isset($_POST['btnCheckingWithdraw'])) {

        //get amounts
        $checkingWithdrawal = filter_input(INPUT_POST, 'cWithdrawAmnt', FILTER_VALIDATE_FLOAT); 

        //validate
        if ($checkingWithdrawal != ""){
    
            $checking->withdrawal($checkingWithdrawal);

        }
    }
    if (isset($_POST['btnSavingsWithdraw'])) {

        //get amounts
        $savingsWithdrawal = filter_input(INPUT_POST, 'sWithdrawAmnt', FILTER_VALIDATE_FLOAT); 
        
        //validate
        if ($savingsWithdrawal != "")
        {
            $savings->withdrawal($savingsWithdrawal);
        }
    }
    if (isset($_POST['btnCheckingDeposit'])) {
        
        //get amounts
        $checkingDeposit = filter_input(INPUT_POST, 'cDepositAmnt', FILTER_VALIDATE_FLOAT); 

        //validate
        if ($checkingDeposit != ""){
           
            $checking->deposit($checkingDeposit);

        }
    }
    if (isset($_POST['btnSavingsDeposit'])) {
        
        //get amounts
        $savingsDeposit = filter_input(INPUT_POST, 'sDepositAmnt', FILTER_VALIDATE_FLOAT); 

        //validate
        if ($savingsDeposit != "")
        {
            $savings->deposit($savingsDeposit);
        }
    }



require "index.view.php";

