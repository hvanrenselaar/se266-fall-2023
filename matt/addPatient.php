<?php
        
        include __DIR__ . '/model/model_patients.php';
        include __DIR__ . '/functions.php';
       if (isPostRequest()) {
           $patientFirstName = filter_input(INPUT_POST, 'patientFirstName');
           $patientLastName = filter_input(INPUT_POST, 'patientLastName');
           $PatientMarried = filter_input(INPUT_POST, 'patientMarried');
           $PatientBirthDate = filter_input(INPUT_POST, 'patientBirthDate');
           $result = addPatient ($patientFirstName, $patientLastName, $PatientMarried, $PatientBirthDate);
           
       }
    ?>
    

<html lang="en">
<head>
  <title>Add Patient</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
   

    
<div class="container">
    
  <h2>Add Patient</h2>
  <form class="form-horizontal" action="addPatient.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="patient name">Patient First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="patientFirstName" placeholder="Enter First Name" name="patientFirstName">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Patient Last Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="patientLastName" placeholder="Enter Last Name" name="patientLastName">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Patient Marital Status:</label>
      <div class="col-sm-10">          
        <input type="radio" class="form-control" id="patientMarriedYes" name="patientMarried" value="1">
        <label for="patientMarriedYes">Married</label>
        <input type="radio" class="form-control" id="patientMarriedNo" name="patientMarried" value="0">
        <label for="patientMarriedYes">Unmarried</label>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Patient Birthdate:</label>
      <div class="col-sm-10">          
        <input type="date" class="form-control" id="patientBirthDate" name="patientBirthDate">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Add Patient</button>
        <?php
            if (isPostRequest()) {
                echo "Patient added";
            }
        ?>
      </div>
    </div>
  </form>
  
  <div class="col-sm-offset-2 col-sm-10"><a href="./viewPatients.php">View Patients</a></div>
</div>

</body>
</html>