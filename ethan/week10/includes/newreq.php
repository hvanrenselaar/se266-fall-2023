<?php
require_once __DIR__ . "/../models/model_Events.php"; 

$beers = getBeers();
$breweries = getBrewers();
$styles = getStyles();

if (isset($req)) {
    $reqID = strval($req->ReqID());
    $reqType = $req->ReqType();
    $reqValue = $req->Value();
} else {
    $reqID = 'newReq';
    $reqType = '';
    $reqValue = '';
}

?>
<form class="form-horizontal" action="edit_event.php?action=updateReq&eventId=<?=$eventId?>&reqId=<?= $reqID?>" method="post">
    <div class="requirements form-group row">
        <input type="hidden" name="eventId" value="<?=$eventId?>"/>
        <input type="hidden" name="reqID" value="<?=$reqID?>"/>
        <div class="col-sm-3 col-sm-offset-1">
            <label class="control-label">Requirement Type:</label><br>
            <div class="form-group row">
                <div class="col-sm-offset-1">
                    <input type="radio"  name="reqType" value='drink' <?php if ($reqType == 'drink') echo 'checked'; ?> /> Drink <br>
                    <input type="radio"  name="reqType" value='brewer' <?php if ($reqType == 'brewer') echo 'checked'; ?> /> Brewer <br>
                    <input type="radio"  name="reqType" value='style' <?php if ($reqType == 'style') echo 'checked'; ?> /> Style
                </div>
            </div>
        </div>

        <div class="drinkReq col-sm-5" style="display: none;">
            <br><label>Required Drink:</label><br>
            <select name='reqDrinkVal' class="selectpicker" data-live-search="true">
                <option value=''>Select a Drink</option>
                <?php foreach ($beers as $beer){
                    echo "<option value = '" . $beer['id'] . "'";
                    if ($beer['beerName'] == $reqValue) echo " selected ";
                    echo ">" . $beer['beerName'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="brewerReq col-sm-5" style="display: none;">
            <br><label>Required Brewer:</label><br>
            <select  name='reqBrewerVal' class="selectpicker" data-live-search="true">
                <option value=''>Select a Brewer</option>
                <?php foreach ($breweries as $brewer){
                    echo "<option value = '" . $brewer['id'] . "'";
                    if ($brewer['brewerName'] == $reqValue) echo " selected ";
                    echo ">" . $brewer['brewerName'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="styleReq col-sm-5" style="display: none;">
            <br><label>Required Style:</label> <br>
            <select  name='reqStyleVal' class="selectpicker" data-live-search="true">
                <option value=''>Select a Style</option>
                <?php foreach ($styles as $style){
                    echo "<option";
                    if ($style['style'] == $reqValue) echo " selected ";
                    echo ">" . $style['style'] . "</option>";
                } ?>
            </select>
        </div>  
        <div class="col-sm-2">
            <br>
            <?php if (isset($req)): ?>
                <button type="submit" class="btn btn-default" name="btnUpdateReq">Update Req</button>
                <button type="submit" class="btn btn-default" name="btnDeleteReq">Delete Req</button>
            <?php else: ?>
                <button type="submit" class="btn btn-default" name="btnAddReq">Add Req</button>
            <?php endif; ?>
        </div>                            
    </div>
</form>