<?php
        include __DIR__ . '/SQL/model_patients.php';
        include __DIR__ . '/functions.php';
        
        
        // let's figure out if we're doing update or add
        if (isset($_GET['action'])) {
            $action = filter_input(INPUT_GET, 'action');
            $id = filter_input(INPUT_GET, 'patientId');
            if ($action == "update") {
                $row = getPatient($id);
                $patient = new Patient($row['patientFirstName'], $row['patientLastName'], $row['patientBirthDate'], $row['patientHeight'], $row['patientWeight'], $row['patientMarried']);

            } else {

              $patient = null;

            }
            
            
        } elseif (isset($_POST['action'])) {
            $action = filter_input(INPUT_POST, 'action');
            $firstName = filter_input(INPUT_POST, 'firstName');
            $id = filter_input(INPUT_POST, 'patientId');
            $lastName = filter_input(INPUT_POST, 'lastName');
            $birthDay = filter_input(INPUT_POST, 'birthDate');
            $married = $_POST["married"];
            $feet = filter_input(INPUT_POST, 'feet');
            $inches = filter_input(INPUT_POST, 'inches');
            $weight = filter_input(INPUT_POST, 'weight');

            $patient = new Patient($firstName, $lastName, $birthDay, (intval($feet) * 12 + intval($inches)), $weight, $married);

        } 
            
       
       if (isPostRequest() && $action == "add") {
       
          $result = addPatient ($patient);
          header('Location: index.php');
           
       } elseif (isPostRequest() && $action == "update") {
           $result = updatePatient ($id, $patient);
           header('Location: index.php');
           
       }
    ?>
    

<head>
  <title>Add A Patient</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
   
<?php require "head.php"; require "menu.php"; ?>
<div class="w3-section ">    
  <div class="card w3-light-grey w3-padding">

    <div class="card-block">

      <div class="row">
        <h2 class="text-left col-sm-9">Patient Info</h2>
        <div class="col-sm-1 col-sm-offset-2 ">
          <a href="./index.php" class="btn btn-primary-outline pull-right">View All</a>
        </div> 
      </div>

    </div>    

    <div class="card-body">

      <form class="form-horizontal" action="editPatient.php" method="post">

        <input type="hidden" name="action" value="<?php echo $action; ?>">
        <input type="hidden" name="patientId" value="<?php echo $id; ?>">

        <div class="card-text">
            <div class="form-group row">
              <label class="control-label col-sm-1">Name: </label>
              <div class="col-sm-10">
                <div class="row row-no-gutters">
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName" value="<?php if (isset($patient)) echo $patient->FName(); ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName" value="<?php if (isset($patient)) echo $patient->LName(); ?>">
                  </div>
                </div>
              </div>
            </div>
        
            <div class="form-group row">
              <div class="col-sm-2">
                <label class="control-label">Married:</label>
                <div class="text-center">
                  <input type="radio" id="married" name="married" value=1 <?php if (isset($patient)) if ($patient->Married() == 1) echo 'checked'; ?> /> Yes</br>
                  <input type="radio" id="married" name="married" value=0 <?php if (isset($patient)) if ($patient->Married() == 0) echo 'checked'; ?> /> No
                </div>
              </div>

              <div class="col-sm-3">
                <label class="control-label">BirthDate:</label>
                <input type="date" class="form-control" id="birthDate" placeholder="Enter BirthDate" name="birthDate" value="<?php if (isset($patient)) echo $patient->BDay(); ?>">
              </div>

              <div class="col-sm-3">
                <label class="control-label">Height:</label>
                  <div class="row row-no-gutters">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="feet" placeholder="Feet" name="feet" value="<?php if (isset($patient)) echo $patient->Feet(); ?>">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inches" placeholder="Inches" name="inches" value="<?php if (isset($patient)) echo $patient->Inches(); ?>">
                    </div>
                </div>
              </div>
          
              <div class="col-sm-3">
                <label class="control-label">Weight:</label>
                <input type="text" class="form-control" id="weight" placeholder="lbs" name="weight" value="<?php if (isset($patient)) echo $patient->Weight(); ?>">
              </div>
            </div>

        </div>

        <div class="form-group row">        
          <div class="col-sm-offset-5 col-sm-1">
            <button type="submit" class="btn btn-default"><?php echo ucwords($action); ?> Patient</button>
          </div>
        </div>
          
      </form>
    </div>

  </div>
</div>