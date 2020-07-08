<?php

    class Height {

        protected $feet, $inches;
        public function __construct ($in) {
            // write code here
            $this->feet = floor($in/12);
            $this->inches = ($in%12);
        }
        public function HeightInInch(){

            return $this->feet * 12 + $this->inches; //defualt returns height in inches
        }

        public function Feet ()
        {
            return $this->feet;
        }
        public function Inches ()
        {
            return $this->inches;
        }

    }
    class Patient {

        protected $fName, $lName, $bDay, $married;
        
        public function __construct ($fName, $lName, $bDay, $married) {
           // write code here
           $this->fName = $fName;
           $this->lName = $lName;
           $this->bDay = $bDay;
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
        public function Married() {
            return $this->married;
        }             
        public function Age() {
            $date = new DateTime($this->bDay);
            $now = new DateTime();
            $interval = $now->diff($date);
            return $interval->y;
        }

    }
    class Record
    {
        protected $visitDate, $height, $weight, $bpSystolic, $bpDiastolic, $temperature, $patientID;

        public function __construct ($visitDate, $height, $weight, $bpSystolic, $bpDiastolic, $temperature, $patientID) {
            $this->visitDate = $visitDate;
            $this->height =  $height;
            $this->weight = intval($weight);
            $this->bpSystolic = intval($bpSystolic);
            $this->bpDiastolic = intval($bpDiastolic);
            $this->temperature = intval($temperature);
            $this->patientID = $patientID;
        }

        public function PatientID()
        {
            return $this->patientID;
        }
        public function Height() {
            return $this->height;
        }     

        public function Weight() {
            return $this->weight;
        }     

        public function VisitDate() {
            return $this->visitDate;
        }     

        public function BPSystolic() {
            return $this->bpSystolic;
        }     

        public function BPDiastolic() {
            return $this->bpDiastolic;
        }     

        public function Temperature() {
            return $this->temperature;
        }     
        public function BMI ()
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

    
