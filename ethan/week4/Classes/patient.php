<?php

    class Height {
        protected $feet, $inches;
        public function __construct ($in) {
            // write code here
            $this->feet = floor($in/12);
            $this->inches = ($in%12);
         }
        public function Feet ()
        {
            return $this->feet;
        }
        public function Inches ()
        {
            return $this->inches;
        }
        //will store all sql values in only inches. Use these two functions to convert object to inches or inches to object
        public function HeightInInch()
        {
            return $this->feet * 12 + $this->inches;
        }
    }
    class Patient {

        protected $fName, $lName, $bDay, $height, $weight, $married;
        
        public function __construct ($fName, $lName, $bDay, $height, $weight, $married) {
           // write code here
           $this->fName = $fName;
           $this->lName = $lName;
           $this->bDay = $bDay;
           $this->height = new Height(intval($height));
           $this->weight = $weight;
           $this->married = intval($married);
        }
        public function FName() {
            return $this->fName;
        } 
        public function LName() {
            return $this->lName;
        }
        public function BDay() {
            return $this->bDay;
        }
        public function Feet() {
            return $this->height->Feet(); //is there way to have this be nested?
        }
        public function Inches() {
            return $this->height->Inches();
        }
        public function Height() {
            return $this->height->HeightInInch();
        }
        public function Weight() {
            return $this->weight;
        }
        public function Married() {
            return $this->married;
        }             
        public function Age() {
            $date = new DateTime($this->bDay);
            $now = new DateTime();
            $interval = $now->diff($date);
            return $interval->y;
        }

        function BMI ()
        {
            //weight to kg
            $kg = ($this->weight * 0.453592);
    
            $meters = 0.0254 * $this->Height();
    
            //bmi function
            return round(($kg / ($meters * $meters)), 2);
        }
         function BMIDescription () {
            $bmi = $this->BMI();
            if ($bmi < 18.5) {return "Under";}
            else if (18.5 <= $bmi && $bmi <= 24.9) {return "Normal";}
            else if (25 <= $bmi && $bmi <= 30) {return "Over";}
            else {return "Obese";}
        }
    }

    