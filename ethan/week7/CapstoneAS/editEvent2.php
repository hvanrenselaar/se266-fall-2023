<?php 
    require_once __DIR__ . "/classes/class_Event.php"; 
    require_once __DIR__ . "/models/model_Events.php"; 

    //will refrence later
    $beers = getBeers();
    $breweries = getBrewers();
    $styles = getStyles();


    // let's figure out if we're doing update or add
    if (isset($_GET['action'])) {
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'eventId');
        if ($action == "update") {
            $event = getEvents($id)->toArray()[0];
        } else {
            $event = null;
        }
    }
        //set the title to the action and include  our header
        $title = ucwords($action) . " Event";
        require_once __DIR__ . "/includes/head.php";
?>
<html>
<body>
    <div class="card w3-padding">
    
        <div class="card-block">

                <div class="row">
                    <h2 class="text-center">Event Info</h2>
                </div>

        </div>    

        <div class="card-body"> 
            <form class="form-horizontal" action="editEvent.php?action=<?php echo $action; if (isset($id)) echo "&patientId=" . $id; ?>" method="post">
                <?php if (isset($event)): //if id is set add our hidden form, if not we dont care about it?>
                    <input type="hidden" name="eventId" value="<?php echo $id; ?>">
                <?php endif; ?>

                <div class="card-text">
                    <div class="form-group row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <label class="control-label" for="eventName">Event Title: </label>
                            <input type="text" class="form-control" id="eventName"  name="eventName" value="<?php if (isset($event)) echo $event->Name(); ?>">
                            <input type="hidden" class="form-control" id="eventID"  name="eventID" value="<?php if (isset($event)) echo $event->ID(); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-1">
                            <label class="control-label" for="date">Date: </label>
                            <input type="date" class="form-control" id="eventDate" name="eventDate" value="<?php if (isset($event)) echo $event->EventStart()->format('Y-m-d'); ?>">
                        </div>

                        <div class="col-sm-3">
                            <label class="control-label" for="eventStart">Start : </label>
                            <input type="time" class="form-control" id="eventStart" name="eventStart" value="<?php if (isset($event)) echo $event->EventStart()->format('H:i'); ?>">
                        </div>

                        <div class="col-sm-3">
                            <label class="control-label" for="eventEnd">End : </label>
                            <input type="time" class="form-control" id="eventEnd" name="eventEnd" value="<?php if (isset($event)) echo $event->EventEnd()->format('H:i'); ?>">
                        </div>
                    </div>

                    <div id="requirements">
                    
                    </div>

                    <div class="form-group row w3-center">
                        <input type="button" id="deletebutton" class="btn btn-default" name="submit" value="<?= ucwords($action) ?> Event">
                    </div>
                
            </form> 
        </div>
    </div>
<body>
</html>
<script>
    async function getEventInfo($id){
        const url = './includes/requirements.php';
        const data = { action: 'getEvent', eventID: $id };

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const eventdata = await response.json();
            adjustRequirements(eventdata);
        } catch (error) {
            console.error(error);
        } 
    }

    asy

    $( document ).ready(function() {

        $id = $('#eventID').val();
        getEventInfo($id);

        $('.selectpicker').selectpicker();
        for (const rb of $(":radio")) {
            if (rb.checked) {
                toggleInputs(rb);
            }
        }
 
    });

    function addRequirement(id='temp', type=null, value=null)
    {
        strReq = '<div class="requirements form-group row"><input type="hidden" name="reqID" value="' + id + '" />'; 
        strReq += '<div class="col-sm-3 col-sm-offset-1"><label class="control-label">Requirement Type:</label><br> <div class="form-group row"><div class="col-sm-offset-1">';
        strReq += '<input type="radio" id="req' + id + '" name="req' + id + '" value="drink" ';
        if (type=='drink') {strReq += ' checked ';}
        strReq += 'onclick="toggleInputs(this);"/> Drink <br>'
        strReq += '<input type="radio" id="req' + id + '" name="req' + id + '" value="brewer"';
        if (type=='brewer') {strReq += ' checked ';}
        strReq += 'onclick="toggleInputs(this);"/> Brewer <br>';
        strReq += '<input type="radio" id="req' + id + '" name="req' + id + '" value="style"';
        if (type=='style') {strReq += ' checked ';}
        strReq += 'onclick="toggleInputs(this);"/> Style </div></div></div>';
        strReq += '<div class="drinkReq col-sm-5" style="display: none;"><br><label>Required Drink:</label><br><select class="selectpicker drinkSelector" data-live-search="true"><option value="0">Select a Beer</option></select></div>';
        strReq += '<div class="brewerReq col-sm-5" style="display: none;"><br><label>Required Brewer:</label><br><select class="selectpicker" data-live-search="true"><option value="0">Select a Brewer</option></select></div>';
        strReq += '<div class="styleReq col-sm-5" style="display: none;"><br><label>Required Style:</label> <br><select class="selectpicker" data-live-search="true"><option value="0">Select a Style</option></select></div></div>'
        console.log(strReq);
        $("#requirements").append(strReq);
    }
    function selectInput(object, value){
        var req = selectObj.parentNode.parentNode;
        $('.selectpicker', req).selectpicker('val', value);
        
    } 
    function adjustRequirements(event=null){
        //init first requirement regardless
        if (event==null){
            addRequirement();
        }
        else{
            for (i = 0; i < event['requirementTypes'].length; i++)
            {
                addRequirement(event['reqIDs'][i], event['requirementTypes'][i], event['requirementValues'][i]);  
            }
        }
    }
    function toggleInputs(selectObj){
        var req = selectObj.parentNode.parentNode.parentNode.parentNode;
        if(selectObj.value == 'drink'){
            $(".drinkReq", req).show();
            $(".brewerReq", req).hide();
            $(".styleReq", req).hide();
        } else if (selectObj.value == 'brewer'){
            $(".drinkReq", req).hide();
            $(".brewerReq", req).show();
            $(".styleReq", req).hide();
        } else if (selectObj.value == 'style'){
            $(".drinkReq", req).hide();
            $(".brewerReq", req).hide();
            $(".styleReq", req).show();
        }
    }
    function addOptions(){

    }
    
    

</script>