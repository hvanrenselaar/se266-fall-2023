<?php
require_once __DIR__ . "/../models/model_Events.php"; 

$beers = getBeers();
$breweries = getBrewers();
$styles = getStyles();

if (isset($req)) {
    $reqID = $req->ReqID();
    $reqType = $req->ReqType();
    $reqValue = $req->Value();
} else {
    $reqID = 'tempReq';
    $reqType = '';
    $reqValue = '';
}
?>
<form class="form-horizontal" action="editEvent.php?action=update&eventId=<?=$id ?>&reqID=<?php (isset($req)) ? $req->ReqID() : 'new'?>" method="post">
    <div class="requirements form-group row">
        <div class="col-sm-3 col-sm-offset-1">
            <label class="control-label">Requirement Type:</label><br>
            <div class="form-group row">
                <div class="col-sm-offset-1">
                    <input type="radio"  id="req<?=$reqID?>" name="req<?=$reqID?>" value='drink' <?php if ($reqType == 'drink') echo 'checked'; ?> /> Drink <br>
                    <input type="radio"  id="req<?=$reqID?>" name="req<?=$reqID?>" value='brewer' <?php if ($reqType == 'brewer') echo 'checked'; ?> /> Brewer <br>
                    <input type="radio"  id="req<?=$reqID?>" name="req<?=$reqID?>" value='style' <?php if ($reqType == 'style') echo 'checked'; ?> /> Style
                </div>
            </div>
        </div>

        <div class="drinkReq col-sm-5 align middle" style="display: none;">
            <br><label>Required Drink:</label><br>
            <select class="selectpicker" data-live-search="true">
                <option value='0'>Select a Drink</option>
                <?php foreach ($beers as $beer){
                    echo "<option value = '" . $beer['id'] . "'";
                    if ($beer['beerName'] == $reqValue) echo " selected ";
                    echo ">" . $beer['beerName'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="brewerReq col-sm-5" style="display: none;">
            <br><label>Required Brewer:</label><br>
            <select class="selectpicker" data-live-search="true">
                <option value='0'>Select a Brewer</option>
                <?php foreach ($breweries as $brewer){
                    echo "<option value = '" . $brewer['id'] . "'";
                    if ($brewer['brewerName'] == $reqValue) echo " selected ";
                    echo ">" . $brewer['brewerName'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="styleReq col-sm-5" style="display: none;">
            <br><label>Required Style:</label> <br>
            <select class="selectpicker" data-live-search="true">
                <option value='0'>Select a Style</option>
                <?php foreach ($styles as $style){
                    echo "<option";
                    if ($style['style'] == $reqValue) echo " selected ";
                    echo ">" . $style['style'] . "</option>";
                } ?>
            </select>
        </div>  
        <div class="col-sm-2 col-sm-offset-1">
            <?php if (isset($req)): ?>
                <input type="button" id="updateReq" class="btn btn-default" name="updateReq" value="Update Req">
                <input type="button" id="deleteReq" class="btn btn-default" name="deleteReq" value="Delete Req">
            <?php else: ?>
                <input type="button" id="addReq" class="btn btn-default" name="addReq" value="Add Req">
            <?php endif; ?>
        </div>                            
    </div>
</form>