<?php
    abstract class Account {
        protected $accountId, $balance, $startDate;
        
        public function __construct ($id, $b, $sd) {
           $this->accountId = $id;
           $this->balance = $b;
           $this->startDate = $sd;
        }
        public function deposit ($amount) {
            echo "<br>Start balance:" . $this->balance;
            $this->balance += $amount;
            echo "<br>End balance:" . $this->balance;
        }

        abstract public function withdrawal($amount);
        // this is an abstract method. This method must be defined in all classes
        // that inherit from this class
        public function getStartDate() {
            return $this->startDate;
        }

        public function getBalance() {
            return $this->balance;
        }

        public function getAccountId() {
            return $this->accountId;
        }

        protected function getAccountDetails() {
            // populate $str with the account details
            $str = "ID: " . $this->accountId . "<br>Balance: " .  $this->balance . "<br>Account Opened: " . $this->startDate;
            return $str;
        }
    }

    class CheckingAccount extends Account {
        const OVERDRAW_LIMIT = -200;


        public function withdrawal($amount) {
            if(($this->balance - $amount) < self::OVERDRAW_LIMIT)
            {
                echo "<br>Withdrawal exceeds overdraw limit";
                return false;
            }
            else
            {
                echo "<br>Start balance:" . $this->balance . "<br>";
                $this->balance -= $amount;
                echo "<br>End balance:" . $this->balance . "<br>";
                return true;
            }
        }

        //freebie. I am giving you this code.
        public function getAccountDetails() {
            $str = "<h2>Checking Account</h2>";
            $str .= parent::getAccountDetails();
            
            return $str;
        }
    }

    class SavingsAccount extends Account {

        public function withdrawal($amount) {
            // write code here. Return true if withdrawal goes through; false otherwise
            echo "<br>Start balance:" . $this->balance;
            $this->balance -= $amount;
            echo "<br>End balance:" . $this->balance;
        }

        public function getAccountDetails() {
           // look at how it's defined in other class. You should be able to figure this out ...
            $str = "<h2>Savings Account</h2>";
            $str .= parent::getAccountDetails();
            
            return $str;
        }
    }

    
    

    $checkDepositAmount = filter_input(INPUT_POST, 'checkingDepositAmount');
    $checkWithdrawAmount = filter_input(INPUT_POST, 'checkingWithdrawAmount');
    $savingsDepositAmount = filter_input(INPUT_POST, 'savingsDepositAmount');
    $savingsWithdrawAmount = filter_input(INPUT_POST, 'savingsWithdrawAmount');
    $checkingsBalance = filter_input(INPUT_POST, 'checkingBalance');
    $savingsBalance = filter_input(INPUT_POST, 'savingsBalance');

    //if(isset($_POST))
    //{
        //$checking = new CheckingAccount ('C123', $checking->getBalance(), '12-20-2019');
        //$savings = new SavingsAccount('S123', $savings->getBalance();, '03-20-2020');
    //}
    //else
    //{
        $savings = new SavingsAccount('S123', 5000, '03-20-2020');
        $checking = new CheckingAccount ('C123', 1000, '12-20-2019');
    //}
    
    //$checking->withdrawal(200);
    //$checking->deposit(500);

    
    
    echo $checking->getAccountDetails();
    echo $savings->getAccountDetails();
    //echo $checking->getStartDate();
    
    if (isset($_POST['depositChecking']))
    {
        echo "<br><br>Checkings deposit " . $checkDepositAmount;
        $checking->deposit($checkDepositAmount);
    }
    if (isset($_POST['withdrawChecking']))
    {
        echo "<br><br>Checkings withdraw " . $checkWithdrawAmount;
        $checking->withdrawal($checkWithdrawAmount);
    }
    if (isset($_POST['depositSavings']))
    {
        echo "<br><br>Savings deposit " . $savingsDepositAmount;
        $savings->deposit($savingsDepositAmount);
    }
    if (isset($_POST['withdrawSavings']))
    {
        echo "<br><br>Savings withdraw " . $savingsWithdrawAmount;
        $savings->withdrawal($savingsWithdrawAmount);
    }

    
require 'atm.php';
    
?>
