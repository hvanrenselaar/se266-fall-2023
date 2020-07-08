<div class="card w3-light-grey w3-padding">
  
  <div class="card-block">

        <div class="row">
            <h2 class="text-left">Visit Info</h2>
        </div>

</div>    

<div class="card-body"> 
    <form class="form-horizontal" action="editPatient.php?action=update&patientId=<?php echo $id; ?>" method="post">
        <input type="hidden" name="patientId" value="<?php echo $id; ?>">
        <div class="card-text">
            <div class="form-group row">
            <label class="control-label col-sm-1">Height: </label>
                <div class="col-sm-7">
                    <div class="row row-no-gutters">
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="feet" placeholder="Feet" name="feet" value="">
                        </div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="inches" placeholder="Inches" name="inches" value="">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-2">Weight: </label>
                    <div class="col-sm-2">

                        <input type="text" class="form-control" id="weight" name="weight" value="">

                    </div>
                </div>
            </div>

            <div class="form-group row">
            <label class="control-label col-sm-1">Blood Pressure: </label>
                <div class="col-sm-5">
                    <div class="row row-no-gutters">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bpSystolic" name="bpSystolic" value="">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bpDiastolic" name="bpDiastolic" value="">
                        </div>
                    </div>
                </div>
                <label class="control-label col-sm-2">Temperature: </label>
                    <div class="col-sm-4">

                        <input type="text" class="form-control" id="temperature" name="temperature" value="">

                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                <label class="control-label">Visit Date:</label>
                <input type="date" class="form-control" id="visitDate" placeholder="Visit Date:" name="visitDate" value="<?= date("Y-m-d"); ?>">
                </div>
             </div>

        <div class="form-group row">        
            <div class="container text-center">
            <button type="submit" name="btnRecord" class="btn btn-default"> Add Record</button>
            </div>
        </div>
        
    </form> 


    <div class="row">
        <h2 class="text-left">History</h2>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Height</th>
                <th>Weight</th>
                <th>BMI</th>
                <th>Blood Pressure</th>
                <th>Temperature</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $records = getRecords($id);
        foreach ($records as $row):
                $record = new Record($row['patientMeasurementDate'], $row['patientHeight'], $row['patientWeight'], $row['patientBPSystolic'], $row['patientBPDiastolic'], $row['patientTemperature'], $id);
                $height = new Height($row['patientHeight']);
        ?>
            <tr>
                <td>
                        <form action="editPatient.php?action=update&patientId=<?php echo $id; ?>" method="post">
                            <input type="hidden" name="measurementID" value="<?php echo $row['patientMeasurementId']; ?>" />
                            <button class="btn glyphicon glyphicon-trash" type="submit" name=
                            "btnRecordDelete"></button>
                            <?php echo $record->VisitDate() ?>
                        </form>
                </td>
                <td> <?= $height->Feet() .  "ft. " . $height->Inches() . " in. " ?></td>
                <td><?= $record->Weight() ?></td> 
                <td><?= $record->BMI() . " - " . $record->BMIDescription()  ?></td>  
                <td><?= $record->BPSystolic() . " / " .$record->BPDiastolic()  ?></td>  
                <td><?= $record->Temperature() ?></td>              
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>