<?php
    require_once (__DIR__ . "/../classes/class_event.php");
    include (__DIR__ . '/db.php'); 

    function getEvents ($id = null) {
        global $db;
        
        $results = [];

        //first get out events
        $strSQL = "SELECT id, title, eventStart, eventEnd FROM eventInfo";
        if ($id != null) //if id is not null, add where clause to statement and execute with binds
        {
            $strSQL .= " WHERE eventinfo.id = :id;";
            $stmt = $db->prepare($strSQL);
            $binds = array(
                ":id" => $id
            );
            if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);          
            }
        }
        else {
            $strSQL .= ";"; //close our statment
            $stmt = $db->prepare($strSQL);

            if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
                 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);             
            }
        }
        
        //parsing results in event objects
        $events = new Events;
        foreach ($results as $row)
        {
            $events->AddEvent(new Event($row['title'], $row['eventStart'], $row['eventEnd'], null, $row['id']));
        }

        //then we get requirements
        foreach ($events->toArray() as $tempevent){
            $strSQL = "Select id, (SELECT beerName FROM beers WHERE requiredeventdrinks.requiredDrink = beers.id) as requiredBeer, (SELECT brewerName FROM breweries WHERE requiredeventdrinks.requiredBrewer = breweries.id) as requiredBrewer, requiredStyle FROM requiredeventdrinks WHERE eventid = :id;";
            $stmt = $db->prepare($strSQL);
            $binds = array(
                ":id" => $tempevent->ID()
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                
                //adding our reqs inside this validation. if rowcount is 0 we dont want to add any reqs
                foreach ($results as $row){
                    $tempReq = new EventRequirement($row['id'], $row['requiredBeer'], $row['requiredStyle'], $row['requiredBrewer']);
                    $tempevent->addReq($tempReq);
                }
            }
        }
        return ($events);
    }
    
    function addEvent(Event $event) 
    {
        global $db;
        
        //first create event in eventInfo table
        $stmt = $db->prepare("INSERT INTO EventInfo SET title = :title, eventStart = :eventStart, eventEnd = :eventEnd");

        $binds = array(
            ":title" => $event->Name(),
            ":eventStart" => $event->EventStart()->format('Y-m-d H:i:s'),
            ":eventEnd" => $event->EventEnd()->format('Y-m-d H:i:s')
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $db->lastInsertId();
        }
        else {
            $results = 'error';
        }
        return $results;
    }
    function addReq($req, $eventID){
        global $db;
        //make our values look pretty for easy sql string
        $sqlValues = array(
            SqlReady($eventID), 
            SqlReady($req->Drink()), 
            SqlReady($req->Brewer()),
            SqlReady($req->Style())
        );
         
        $sqlString = "INSERT INTO requiredeventdrinks (eventID, requiredDrink, requiredBrewer, requiredStyle) VALUES (" . implode(", ",$sqlValues) . ")";
        $db->query($sqlString);
        
    }
    function getBeers()
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM beers ORDER BY beerName");
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);             
       }
       return $results;
    }
    function getBrewers()
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM breweries ORDER BY brewerName");
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);             
       }
       return $results;
    }
    function getStyles()
    {
        global $db;
        $stmt = $db->prepare("SELECT DISTINCT style FROM beers ORDER BY style");
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);             
       }
       return $results;
    }
    function deleteReq ($id) {
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM requiredeventdrinks WHERE id=:id");
        
        $binds = array(
            ":id" => $id
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }
    function deleteEvent ($id) {
        global $db;

        //same bind for both function set up here
        $binds = array(
            ":id" => $id
        );

        //first delete all reqs with event id from event tame
        $stmt = $db->prepare("DELETE FROM requiredeventdrinks WHERE eventid=:id"); 
        $stmt->execute($binds);

        //then we delete the event itself
        $stmt = $db->prepare("DELETE FROM eventinfo WHERE id=:id");
        $stmt->execute($binds);
    }
    function updateEvent($event) {
        global $db;
        
        $stmt = $db->prepare("UPDATE eventInfo SET title = :title, eventStart = :eventStart, eventEnd = :eventEnd WHERE id=:id");
        $results = "";
        $binds = array(
            ":title" => $event->Name(),
            ":eventStart" => $event->EventStart()->format('Y-m-d H:i:s'),
            ":eventEnd" => $event->EventEnd()->format('Y-m-d H:i:s'),
            ":id" => $event->ID()
        );
            
        $stmt->execute($binds);
    }
    function updateReq($req) {
        global $db;
        //getting our values ready for sql because nulls are annoying
        $requiredDrink = ($req->Drink() != '') ? $req->Drink() : NULL;
        $requiredStyle = ($req->Style() != '') ? $req->Style() : NULL;
        $requiredBrewer = ($req->Brewer() != '') ? $req->Brewer() : NULL;

        $stmt = $db->prepare("UPDATE requiredEventDrinks SET requiredDrink = :requiredDrink, requiredStyle = :requiredStyle, requiredBrewer = :requiredBrewer WHERE id=:id");
        $results = "";
        $binds = array(
            ":requiredDrink" => $requiredDrink,
            ":requiredStyle" => $requiredStyle,
            ":requiredBrewer" => $requiredBrewer,
            ":id" => $req->ReqID()
        );
            
        $stmt->execute($binds);
    }
?>
