<?php
    abstract class GenericCollection implements IteratorAggregate
    {
       protected $values = [];
          
        public function getIterator() {
            return new ArrayIterator($this->values);
        }
          
    }

    //creating an object called requirements. This way I will be able to create a list and decipher whether it will be a required drink, brewer, or style
    class EventRequirement {
        protected $drink, $style, $brewer, $reqType, $value;
        public $id;

        //construct. takes all three and sets type. 
        public function __construct ($id = null, $drink = null, $style = null, $brewer = null) {
            // write code here
            {
                $this->id = $id;
                $this->drink = $drink;
                $this->style = $style;
                $this->brewer = $brewer;
                if ($this->drink != null)
                {
                    $this->reqType = "drink";
                    $this->value = $this->drink;
                }
                else if ($this->style != null)
                {
                    $this->reqType = "style";
                    $this->value = $this->style;
                }
                else if ($this->brewer != null)
                {
                    $this->reqType = "brewer";
                    $this->value = $this->brewer;
                }
                else {
                    $this->reqType = null;
                }
            }
            }
            //return type and value based off what is set. doing it this way will only work with one requirement. may change in future to be more dynamic. Will use this for ui stuff
        public function ReqID()
        {
            return $this->id;
        }
        public function Drink ()
        {
            return $this->drink;
        }
        public function Style ()
        {
            return $this->style;
        }
        public function Brewer ()
        {
            return $this->brewer;
        }
        public function ReqType ()
        {
            return $this->reqType;
        }
        public function Value(){
            return $this->value;
        }
    }

    //here i am creating a collection class that will collect a list of requirement objects and return them. Doing it this way allows me to access methods from other classes
    class EventRequirements extends GenericCollection{
        private $eventRequirements = [];

        public function __construct(EventRequirement ...$eventRequirements)
        {
            $this->eventRequirements = $eventRequirements;
        }
        public function newRequirement(EventRequirement $req){
            array_push($this->eventRequirements, $req);
        }
        //would like to put this in abstract class but i touch up on my classes again
        public function toArray() : array {
            return $this->eventRequirements;
          }
          //for use with json serialization
        public function ValuesArray() : array {
            $values = array();
            foreach ($this->toArray() as $req)
            {
                switch ($req->ReqType()){
                    case 'drink':
                        array_push($values, $req->Drink());
                    break;
                    case 'brewer':
                        array_push($values, $req->Brewer());
                    break;
                    case 'style':
                        array_push($values, $req->Style());
                    break;
                }    
            }
            return $values;
        }
        //again for json
        public function ReqTypeArray() : array {
            $values = array();
            foreach ($this->toArray() as $req)
            {
                array_push($values, $req->ReqType());
            }    
            return $values;
        }

        public function IdArray() : array {
            $values = array();
            foreach ($this->toArray() as $req)
            {
                array_push($values, $req->ReqID());
            }    
            return $values;
        }


    }

    class Event implements JsonSerializable{
        //all of these public so I can change them with updateevent
        public $name, $eventStart, $eventEnd, $requiredDrinks, $id;

        //construct. leaving requireddrinks and id as optional
        public function __construct ($name, $eventStart, $eventEnd, EventRequirements $requiredDrinks = null, $id = null) {
            // write code here
            $this->name = $name;
            $this->eventStart = date_create($eventStart);
            $this->eventEnd = date_create($eventEnd);
            if ($this->requiredDrinks == null){$this->requiredDrinks = new EventRequirements();}
            else {$this->requiredDrinks = $requiredDrinks;} //using a collection class that will output a list of the requirement objects
            $this->id = $id;
        }

        public function Name ()
        {
            return $this->name;
        }
        public function EventStart () : DateTime
        {
            return $this->eventStart;
        }
        public function EventEnd() : DateTime
        {
            return $this->eventEnd;
        }
        public function ID ()
        {
            if ($this->id != null) return $this->id;
        }
        public function Requirements() : EventRequirements
        {
            return $this->requiredDrinks;
        }
        public function AddReq(EventRequirement $req)
        {
            $this->requiredDrinks->newRequirement($req);
        }
        public function jsonSerialize(){
            return 
            [
                'id'   => $this->ID(),
                'name' => $this->Name(),
                'eventStartTime' => date_format($this->EventStart(), 'g:i A'),
                'eventEndTime' => date_format($this->EventEnd(), 'g:i A'),
                'eventDate' => date_format($this->EventStart(), 'm/d/y'),
                'requirementTypes' => $this->Requirements()->ReqTypeArray(),
                'requirementValues'  => $this->Requirements()->ValuesArray(),
                'reqIDs' => $this->Requirements()->IdArray()
            ];
        }

    }

    class Events extends GenericCollection{
        private $events = [];

        public function __construct(Event ...$events)
        {
            $this->events = $events;
        }

        //this function will be used to return a list of all ids.
        public function ReturnIDs() {
            $temp = [];
            foreach ($this->events as $e)
                {
                    array_push($temp, $e->ID());
                }
            return $temp;
        }

        public function AddEvent(Event $event){
            array_push($this->events, $event);
        }

        public function toArray() : array {
            return $this->events;
          }
    }






    

    