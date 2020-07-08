<?php
    require_once (__DIR__ . "/../Classes/class_Event.php");
    include (__DIR__ . '/db.php'); 

    function getEvents ($id = null) {
        global $db;
        
        $results = [];

        $strSQL = "SELECT eventinfo.id id, requiredeventdrinks.id reqId, title, eventStart, eventEnd, 
            (SELECT beerName FROM beers WHERE requiredeventdrinks.requiredDrink = beers.id) requiredDrink,
            (SELECT brewerName FROM breweries WHERE requiredeventdrinks.requiredBrewer = breweries.id) requiredBrewer, requiredStyle FROM requiredeventdrinks 
        LEFT OUTER JOIN eventinfo ON requiredeventdrinks.eventid = eventinfo.id";

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
            //check if event already in list. If it is we will add new requirement, otherwise we will add new event
            if (!in_array($row['id'], $events->ReturnIDs()))
            {
                //create event with requirement of row we are on. Init with first requirement
                $events->AddEvent(new Event($row['title'], $row['eventStart'], $row['eventEnd'], 
                    new EventRequirements( new EventRequirement($row['reqId'], $row['requiredDrink'], $row['requiredStyle'], $row['requiredBrewer'])), 
                    $row['id']));
            }
            else 
            {
                //loop through events to find which one has matching id to add requirements
                foreach ($events->toArray() as $event)
                {
                    //if the event id is same as current row add the requirment to the event
                    if ($event->ID() == $row['id']) $event->AddReq($row['reqId'], $row['requiredDrink'], $row['requiredStyle'], $row['requiredBrewer']);
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
            $results = 'Data Added';
        }
        
        //get our id for adding to the requirements table
        $id = $db->lastInsertId();

        //make an array of requirements
        $reqsArray = $event->Requirements()->toArray();
        foreach ($reqsArray as $req)
        {
            ($req->Drink() != "") ? $drink = "'" . $req->Drink() . "'" : $drink = 'NULL';
            ($req->Style() != "") ? $style = "'" . $req->Style() . "'"  : $style = 'NULL';
            ($req->Brewer() != "") ? $brewer = "'" . $req->Brewer() . "'" : $brewer = 'NULL';

            $sql[] = "('" . strval($id) . "', " . $drink . ", " . $style . ", " . $brewer . ")";
        }
        var_dump($sql);
        $db->query('INSERT INTO requiredeventdrinks (eventID, requiredDrink, requiredStyle, requiredBrewer) VALUES ' .implode(',', $sql));

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
?>
