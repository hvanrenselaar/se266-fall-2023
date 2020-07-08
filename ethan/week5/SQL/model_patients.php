<?php
    require_once (__DIR__ . "/../Classes/patient.php");
    include (__DIR__ . '/db.php'); 
    
    function getPatients () {
        global $db;
        
        $results = [];
        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patientsWeek5");
     
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
         }
         return ($results);
    }
    function getRecords ($id) {
        global $db;
        $results = [];
        $stmt = $db->prepare("SELECT patientMeasurementDate, patientHeight, patientWeight, patientBPSystolic, patientBPDiastolic, patientTemperature, patientMeasurementId FROM patientMeasurements WHERE patientId=:patientId");
        
        $binds = array(
            ":patientId" => $id
        );
        
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);   
         }
         return ($results);
    }
    
    function addPatient ($p) {
        global $db;
        
        $stmt = $db->prepare("INSERT INTO patientsWeek5 SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate");

        $binds = array(
            ":patientFirstName" => $p->FName(),
            ":patientLastName" => $p->LName(),
            ":patientMarried" => $p->Married(),
            ":patientBirthDate" => $p->BDay()
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Added';
        }
        
        return ($results);
    }
    function addRecord ($r) {
        global $db;
        $stmt = $db->prepare("INSERT INTO patientMeasurements SET patientId = :patientId, patientMeasurementDate = :patientMeasurementDate, patientWeight = :patientWeight, patientHeight = :patientHeight, patientBPSystolic = :patientBPSystolic, patientBPDiastolic = :patientBPDiastolic, patientTemperature = :patientTemperature");

        $binds = array(
            ":patientId" => $r->PatientID(),
            ":patientMeasurementDate" => $r->VisitDate(),
            ":patientWeight" => $r->Weight(),
            ":patientHeight" => $r->Height(),
            ":patientBPSystolic" => $r->BPSystolic(),
            ":patientBPDiastolic" => $r->BPDiastolic(),
            ":patientTemperature" => $r->Temperature(),

        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Added';
        }
        
        return ($results);
    }
    function updatePatient($id, $p) {
        global $db;
        
        $stmt = $db->prepare("UPDATE patientsWeek5 SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate WHERE id=:id");
        $results = "";
        $binds = array(
            ":patientFirstName" => $p->FName(),
            ":patientLastName" => $p->LName(),
            ":patientMarried" => $p->Married(),
            ":patientBirthDate" => $p->BDay(),
            ":id" => $id
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Updated';
        }
        
        return ($results);
    }
    function deletePatient ($id) {
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM patientsWeek5 WHERE id=:id");
        
        $binds = array(
            ":id" => $id
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }
    function deleteRecord ($id) {
        global $db;
        
        $results = "Data was not deleted";
        $stmt = $db->prepare("DELETE FROM patientMeasurements WHERE patientMeasurementId=:id");
        
        $binds = array(
            ":id" => $id
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Deleted';
        }
        
        return ($results);
    }
    
    function getPatient ($id) {
         global $db;
        
        $result = [];
        $stmt = $db->prepare("SELECT patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patientsWeek5 WHERE id=:id");
        $binds = array(
            ":id" => $id
        );
       
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        
         }
         
         return ($result);
    }
  
  function getFieldNames () {
      $fieldNames = ['patientFirstName', 'patientLastName', 'patientMarried', 'patientBirthdate'];
      
      return ($fieldNames);
      
  }
?>

