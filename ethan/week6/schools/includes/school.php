<?php

    class School {

        protected $name, $city, $state;
        public function __construct ($name, $city, $state) {
            // write code here
            $this->name = $name;
            $this->city = $city;
            $this->state = $state;
        }

        public function Name(){

            return $this->name;
        }

        public function City ()
        {
            return $this->city;
        }
        
        public function State ()
        {
            return $this->state;
        }

    }
 

    
