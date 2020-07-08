<?php


function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function addReqs($reqCounter){
    for ($i = 0; $i < $reqCounter.count(); $i++)
    {
        echo const;
    }
}

?>
<script>
<option value='0'>Select a Drink</option>
                    <?php foreach ($beers as $beer){ echo "<option value = '" . $beer['id'] . "'>" . $beer['beerName'] . "</option>"; } ?> 




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
                        <?php if (isset($event)):
                            foreach($event->Requirements()->toArray() as $req): 
                        ?>
                            <div class="requirements form-group row">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <label class="control-label">Requirement Type:</label><br>
                                    <div class="form-group row">
                                        <div class="col-sm-offset-1">
                                            <input type="radio"  id="req<?=$reqCounter?>" name="req<?=$reqCounter?>" value='drink' <?php if (isset($event)) if ($req->ReqType() == 'drink') echo 'checked'; ?> onclick="toggleInputs(this);"/> Drink <br>
                                            <input type="radio"  id="req<?=$reqCounter?>" name="req<?=$reqCounter?>" value='brewer' <?php if (isset($event)) if ($req->ReqType() == 'brewer') echo 'checked'; ?> onclick="toggleInputs(this);"/> Brewer <br>
                                            <input type="radio"  id="req<?=$reqCounter?>" name="req<?=$reqCounter?>" value='style' <?php if (isset($event)) if ($req->ReqType() == 'style') echo 'checked'; ?> onclick="toggleInputs(this);"/> Style
                                        </div>
                                    </div>
                                </div>

                                <div class="drinkReq col-sm-5 align middle" style="display: none;">
                                    <br><label>Required Drink:</label><br>
                                    <select class="selectpicker" data-live-search="true">
                                        <option value='0'>Select a Drink</option>
                                        <?php foreach ($beers as $beer){
                                            echo "<option value = '" . $beer['id'] . "'>" . $beer['beerName'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="brewerReq col-sm-5" style="display: none;">
                                    <br><label>Required Brewer:</label><br>
                                    <select class="selectpicker" data-live-search="true">
                                        <option value='0'>Select a Brewer</option>
                                        <?php foreach ($breweries as $brewer){
                                            echo "<option value = '" . $brewer['id'] . "'>" . $brewer['brewerName'] . "</option>";
                                        } ?>
                                    </select>
                                </div>

                                <div class="styleReq col-sm-5" style="display: none;">
                                    <br><label>Required Style:</label> <br>
                                    <select class="selectpicker" data-live-search="true">
                                        <option value='0'>Select a Style</option>
                                        <?php foreach ($styles as $style){
                                            echo "<option>" . $style['style'] . "</option>";
                                        } ?>
                                    </select>
                                </div>                              
                            </div>
                        <?php
                            endforeach;
                        endif; 
                        ?>