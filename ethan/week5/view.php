   
    
    <?php
        require (__DIR__ . "/Classes/patient.php");
        include __DIR__ . '/SQL/model_patients.php';
        include __DIR__ . '/functions.php';

        $patients = getPatients();
    ?>
  
  <div class="w3-card w3-margin w3-light-grey">    
        
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Married</th>
                </tr>
            </thead>
            <tbody>
           
            
            <?php foreach ($patients as $row):
                    $patient = new Patient($row['patientFirstName'], $row['patientLastName'], $row['patientBirthDate'], $row['patientMarried']);
                    $id = $row['id'];
            ?>
                <tr>
                    <td><?php echo $patient->FName() . " " . $patient->LName(); ?></td>
                    <td> <?= $patient->BDay() ?></td>
                    <td> <?= $patient->Age() ?></td>
                    <td><?php if ($patient->Married() == 1) echo "Yes"; else echo "No"; ?></td> 
                    <td><a href="./editPatient.php?action=update&patientId=<?php echo $row['id']; ?>">Edit</a></td> 
                    
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
    </div>
    <div class="w3-sections text-center">
        <a href="editPatient.php?action=add" class="btn btn-default w3-white w3-round">Add Patient</a>
    </div>

