<?php
require_once __DIR__ . "/../models/model_Events.php"; 

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if ($contentType === "application/json"){
    //get raw post data
    $content = trim(file_get_contents("php://input"));
    $decoded = json_Decode($content, true);

    $action = $decoded['eventID'];
    if ($action == 'eventInfo'){
        $id = $decoded['eventID'];

        $event = getEvents($id)->toArray()[0];
    
        $results = json_encode($event->jsonSerialize());

        echo $results;
    }
    else if ($action == 'choices') //will use this to add options to our list
    {
        $results[0] = getBeers();
        $results[1] = getBrewers();
        $results[2] = getStyles();
    }

}
