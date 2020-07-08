<?php
    abstract class Account {
        protected $accountId, $balance, $startDate;
        
        public function __construct ($id, $b, $sd) {
           // write code here
           $this->accountId = $id;
           $this->balance = $b;
           $this->startDate = $sd;


        }
        public function deposit ($amount) {
            // write code here
            $this->balance += $amount;
        }

        abstract public function withdrawal($amount);
        // this is an abstract method. This method must be defined in all classes
        // that inherit from this class
        public function getStartDate() {
            // write code here
            return $this->startDate;
        }

        public function getBalance() {
            // write code here
            return $this->balance;
        }

        public function getAccountId() {
            // write code here
            return $this->accountId;
        }

        protected function getAccountDetails() {

            $str = "<p class='w3-left-align'>ID: $this->accountId </p> ";
            $str .= "<p class='w3-left-align'>Balance: $this->balance </p> ";
            $str .= "<p class='w3-left-align'>Start Date: $this->startDate </p>";
            return $str;
        }
    }

    class CheckingAccount extends Account {
        const OVERDRAW_LIMIT = -200;

        public function withdrawal($amount) {
            // write code here. Return true if withdrawal goes through; false otherwise
            if ($this->balance - $amount < self::OVERDRAW_LIMIT) {

                return false;
            
            } else {

                $this->balance -= $amount;

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
            if ($this->balance - $amount < 0) {

                return false;
            
            } else {

                $this->balance -= $amount;

                return true;

            }
        }

        public function getAccountDetails() {
           // look at how it's defined in other class. You should be able to figure this out ...
           $str = "<h2>Savings Account</h2>";
           $str .= parent::getAccountDetails();
           
           return $str;
        }
    }
?>
