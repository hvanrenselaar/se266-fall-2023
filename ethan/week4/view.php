<div class="card">    
    <div class="row">
        <h1 class="col-sm-offset-1 col-sm-9">Patients</h1>
        <div class="col-sm-1">
            </br>
            <a href="editPatient.php?action=add">Add Patient</a>
        </div>
    </div>
    
    <?php
        require (__DIR__ . "/Classes/patient.php");
        include __DIR__ . '/SQL/model_patients.php';
        include __DIR__ . '/functions.php';

        if (isPostRequest()) { //better to label it?
            $id = filter_input(INPUT_POST, 'patientID');
            deletePatient($id); 
        }

        $patients = getPatients();
    ?>
  
    
        
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Married</th>
                    <th>BMI </th>
                </tr>
            </thead>
            <tbody>
           
            
            <?php foreach ($patients as $row):
                    $patient = new Patient($row['patientFirstName'], $row['patientLastName'], $row['patientBirthDate'], $row['patientHeight'], $row['patientWeight'], $row['patientMarried']);
                    $id = $row['id'];
            ?>
                <tr>
                    <td>
                            <form action="index.php" method="post">
                                <input type="hidden" name="patientID" value="<?php echo $id; ?>" />
                                <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                                <?php echo $patient->FName() . " " . $patient->LName(); ?>
                            </form>
                   </td>
                    <td> <?= $patient->BDay() ?></td>
                    <td> <?= $patient->Age() ?></td>
                    <td><?php if ($patient->Married() == 1) echo "Yes"; else echo "No"; ?></td> 
                    <td> <?= $patient->BMI() . " - "  . $patient->BMIDescription()?></td>
                    <td><a href="./editPatient.php?action=update&patientId=<?php echo $row['id']; ?>">Edit</a></td> 
                    
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</div>