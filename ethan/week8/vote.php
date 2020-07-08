<?php
require __DIR__ . "/models/model_disney.php"; 

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json"){
    //get raw post data
    $content = trim(file_get_contents("php://input"));
    $decoded = json_Decode($content, true);

    $disneyID = $decoded['disneyID'];

    if( is_array($decoded)) {
        insertDisneyVote($disneyID);
    }
}

$results = getVotes(); 
echo $results; 
