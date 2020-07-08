<?php 
    require_once __DIR__ . "/classes/class_event.php"; 
    require_once __DIR__ . "/models/model_events.php";
    require_once __DIR__ . "/includes/functions.php";
    
    // let's figure out if we're doing update or add
    if (isset($_GET['action'])) {
        $action = filter_input(INPUT_GET, 'action');
        $eventId = filter_input(INPUT_GET, 'eventId');
        if ($action == "update" || $action == "updateReq" ) {
            $event = getEvents($eventId)->toArray()[0];
        } 
        else {
            $event = null;
        }
    }

    if(isset($_POST['btnAdd']) || isset($_POST['btnUpdate'])){
        $eventName = filter_input(INPUT_POST, 'eventName');
        $eventDate = filter_input(INPUT_POST, 'eventDate');
        $eventStartTime = filter_input(INPUT_POST, 'eventStart');
        $eventEndTime = filter_input(INPUT_POST, 'eventEnd');

        //validating that we have info to create an event
        if ($eventName == '' || $eventDate == '' || $eventStartTime == '' || $eventEndTime == ''){
            $alrtMsg = "Not Enough Info to " . ucfirst($action) . "Event!";
            CreateAlert($alrtMsg);
        }
        else {
            if (isset($_POST['btnAdd'])) {
                //change our action to update to add reqs
                $action = 'update';
                $event = new Event ($eventName, $eventDate . " " . $eventStartTime, $eventDate . " " . $eventEndTime);
                
                //add our event and set the id to last inserted sql id
                $eventId = addEvent($event);
                $event->id = $eventId;
            }
            else if (isset($_POST['btnUpdate'])) {
                $event->name = $eventName;
                $event->eventStart = new DateTime($eventDate . " " . $eventStartTime);
                $event->eventEnd = new DateTime($eventDate . " " . $eventEndTime);
                updateEvent($event);
            }
        }
    }
    if (isset($_POST['btnDelete'])){
        deleteEvent($eventId);
        header('Location: listEvents.php');
    }
    if (isset($_POST['btnDeleteReq'])){
        $reqID = filter_input(INPUT_POST, 'reqID');
        deleteReq($reqID);
    }
    if (isset($_POST['btnAddReq']) || isset($_POST['btnUpdateReq'])){
        //init
        $tempReq = new EventRequirement();
        
        $eventId = filter_input(INPUT_POST, 'eventId');
        $reqType = filter_input(INPUT_POST, 'reqType');
        $beer = filter_input(INPUT_POST, 'reqDrinkVal');
        $brewer = filter_input(INPUT_POST, 'reqBrewerVal');
        $style = filter_input(INPUT_POST, 'reqStyleVal');

        //if an input is hidden and still set it will pass the value and mess up our script. Switch case here to only pass the selected reqType
        switch ($reqType){
            case 'drink':
                $tempReq = new EventRequirement(null, $beer, null, null);
            break;
            case 'brewer':
                $tempReq = new EventRequirement(null, null, null, $brewer);
            break;
            case 'style':
                $tempReq = new EventRequirement(null, null, $style, null);
            break;
        }

        if ($tempReq->reqType() == null){
            $alrtMsg = "Requirement Information Must be filled out!";
            CreateAlert($alrtMsg);
        } 
        else {
            if (isset($_POST['btnAddReq'])){
                addReq($tempReq, $eventId);
            }
            if (isset($_POST['btnUpdateReq'])){
                $tempReq->id = $reqID = filter_input(INPUT_POST, 'reqID');
                UpdateReq($tempReq);
            }
            $event = getEvents($eventId)->toArray()[0]; //get new event info
        }
    }


    //set the title to the action and include  our header
    $title = ucwords($action) . " Event";
    include_once __DIR__ . "/includes/head.php";

?>
<body>
    <div class="card w3-padding">

        <div class="card-block">

                <div class="row">
                    <h2 class="col-sm-6 col-sm-offset-1">Event Info</h2>
                    <p class="col-sm-3 col-sm-offset-2"><a href="./list_events.php" class="w3-btn w3-light-grey">Return to Events List</a></p>
                </div>

        </div>    

        <div class="card-body"> 
            <form class="form-horizontal" action="edit_event.php?action=<?php echo $action; if (isset($eventId)) echo "&eventId=" . $eventId; ?>" method="post">
                <?php if (isset($event)): //if id is set add our hidden form, if not we dont care about it?>
                    <input type="hidden" name="eventId" value="<?=$eventId?>"/>
                <?php endif; ?>

                <div class="card-text">
                    <div class="form-group row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label class="control-label" for="eventName">Event Title: </label>
                            <input type="text" class="form-control" id="eventName"  name="eventName" value="<?php if (isset($event)) echo $event->Name(); ?>"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-1">
                            <label class="control-label" for="date">Date: </label>
                            <input type="date" class="form-control" id="eventDate" name="eventDate" value="<?php if (isset($event)) echo $event->EventStart()->format('Y-m-d'); ?>"/>
                        </div>

                        <div class="col-sm-3">
                            <label class="control-label" for="eventStart">Start : </label>
                            <input type="time" class="form-control" id="eventStart" name="eventStart" value="<?php if (isset($event)) echo $event->EventStart()->format('H:i'); ?>"/>
                        </div>

                        <div class="col-sm-3">
                            <label class="control-label" for="eventEnd">End : </label>
                            <input type="time" class="form-control" id="eventEnd" name="eventEnd" value="<?php if (isset($event)) echo $event->EventEnd()->format('H:i'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row w3-center">
                        <?php if (isset($event)): ?>
                            <div class="col-sm-3 col-sm-offset-3">
                                <button type="submit" class="btn btn-default" name="btnUpdate">Update Event Info</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-default" name="btnDelete">Delete</button>
                            </div>
                        <?php else: ?>
                            <button type="submit" class="btn btn-default" name="btnAdd">Add Event</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
                <div class="card-text">
                    <div id="requirements">
                        <?php if (isset($event) && $event->Requirements() != null){
                            foreach($event->Requirements()->toArray() as $req){
                                include __DIR__ . '\includes\newreq.php';
                            }
                            unset($req);
                            include __DIR__ . '\includes\newreq.php';
                        }
                        ?>  
                    </div>
                </div>  
        </div>
    </div>
<body>
<script>
    $( document ).ready(function() {
        var i = 0;
        $('.selectpicker').selectpicker();
        for (const rb of $(":radio")) {
            if (rb.checked) {
                toggleInputs(rb);
            }
        }
    });
    $(":radio").click(function(){toggleInputs(this);});

    function selectInput(object, value){
        var reqObj = selectObj.parentNode.parentNode;
        $('.selectpicker', reqObj).selectpicker('val', value);
    } 
    function toggleInputs(selectObj){
        var reqObj = selectObj.parentNode.parentNode.parentNode.parentNode;
        if(selectObj.value == 'drink'){
            $(".drinkReq", reqObj).show();
            $(".brewerReq", reqObj).hide();
            $(".styleReq", reqObj).hide();
        } else if (selectObj.value == 'brewer'){
            $(".drinkReq", reqObj).hide();
            $(".brewerReq", reqObj).show();
            $(".styleReq", reqObj).hide();
        } else if (selectObj.value == 'style'){
            $(".drinkReq", reqObj).hide();
            $(".brewerReq", reqObj).hide();
            $(".styleReq", reqObj).show();
        }
    }

</script>