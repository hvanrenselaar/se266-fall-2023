<?php 
    require_once __DIR__ . "/classes/class_Event.php"; 
    require_once __DIR__ . "/models/model_Events.php"; 

    // let's figure out if we're doing update or add
    if (isset($_GET['action'])) {
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'eventId');
        if ($action == "update") {
            $event = getEvents($id)->toArray()[0];
        } 
        else {
            $event = null;
        }
    }

    if(isset($_POST['btnAdd'])){
        $visitDate = filter_input(INPUT_POST, 'visitDate');
        $feet = filter_input(INPUT_POST, 'feet');
        $inches = filter_input(INPUT_POST, 'inches');
        $weight = filter_input(INPUT_POST, 'weight');
        $bpSystolic = filter_input(INPUT_POST, 'bpSystolic');
        $bpDiastolic = filter_input(INPUT_POST, 'bpDiastolic');
        $temperature = filter_input(INPUT_POST, 'temperature');
        $record = new Record($visitDate, (intval($feet) * 12 + intval($inches)), $weight, $bpSystolic, $bpDiastolic, $temperature, $id);
        
        if (isPostRequest())
        {
          $result = addRecord($record); 
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
                    <h2 class="text-center">Event Info</h2>
                </div>

        </div>    

        <div class="card-body"> 
            <form class="form-horizontal" action="editEvent.php?action=<?php echo $action; if (isset($id)) echo "&eventId=" . $id; ?>" method="post">
                <?php if (isset($event)): //if id is set add our hidden form, if not we dont care about it?>
                    <input type="hidden" name="eventId" value="<?php echo $id; ?>"/>
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
                            <input type="button" id="buttonUpdate" class="btn btn-default" name="submit" value="Update Event Info">
                            <input type="button" id="buttonDelete" class="btn btn-default" name="submit" value="Delete Event">
                        <?php else: ?>
                            <input type="button" id="buttonAdd" class="btn btn-default" name="submit" value="Add Event">
                        <?php endif; ?>
                    </div>
                </div>
            </form>
                <div class="card-text">
                    <div id="requirements">
                        <?php if (isset($event)){
                            foreach($event->Requirements()->toArray() as $req){
                                include __DIR__ . '\includes\newreq.php';
                            }
                        }
                        include __DIR__ . '\includes\newreq.php';
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