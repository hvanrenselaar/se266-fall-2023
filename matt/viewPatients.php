<?php
        
        include __DIR__ . '/model/model_patients.php';
        $patients = getPatients ();
        
    ?>
    
<html lang="en">
<head>
  <title>View Patient</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        
    <div class="col-sm-offset-2 col-sm-10">
        <h1>Patients</h1>
    
   
  
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient First Name</th>
                    <th>Patient Last Name</th>
                    <th>Patient Marital Status</th>
                    <th>Patient BirthDate</th>
                </tr>
            </thead>
            <tbody>
           
            
            <?php foreach ($patients as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['patientFirstName']; ?></td>
                    <td><?php echo $row['patientLastName']; ?></td>            
                    <td><?php echo $row['patientMarried']; ?></td>            
                    <td><?php echo $row['patientBirthDate']; ?></td>            
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <br />
        <a href="addPatient.php">Add Patient</a>
    </div>
    </div>
</body>
</html>