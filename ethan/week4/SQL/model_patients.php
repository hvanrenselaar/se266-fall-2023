<?php
    require_once (__DIR__ . "/../Classes/patient.php");
    include (__DIR__ . '/db.php'); 
    
    function getPatients () {
        global $db;
        
        $results = [];
        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate, patientHeight, patientWeight FROM patients");
     
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
         }
         
         return ($results);
    }
    
    function addPatient ($p) {
        global $db;
        
        $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate, patientHeight = :patientHeight, patientWeight = :patientWeight");

        $binds = array(
            ":patientFirstName" => $p->FName(),
            ":patientLastName" => $p->LName(),
            ":patientMarried" => $p->Married(),
            ":patientBirthDate" => $p->BDay(),
            ":patientHeight" => $p->Height(),
            ":patientWeight" => $p->Weight()
        );
            
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Added';
        }
        
        return ($results);
    }
    
    function updatePatient($id, $p) {
        global $db;
        
        $stmt = $db->prepare("UPDATE patients SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate, patientHeight = :patientHeight, patientWeight = :patientWeight WHERE id=:id");
        $results = "";
        $binds = array(
            ":patientFirstName" => $p->FName(),
            ":patientLastName" => $p->LName(),
            ":patientMarried" => $p->Married(),
            ":patientBirthDate" => $p->BDay(),
            ":patientHeight" => $p->Height(),
            ":patientWeight" => $p->Weight(),
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
        $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");
        
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
        $stmt = $db->prepare("SELECT patientFirstName, patientLastName, patientMarried, patientBirthDate, patientHeight, patientWeight FROM patients WHERE id=:id");
        $binds = array(
            ":id" => $id
        );
       
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        
         }
         
         return ($result);
    }
    
  
  function searchPatients ($column, $searchValue) {
        
        global $db;
        $results = [];
        $stmt = $db->prepare("SELECT SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthdate, patientHeight, patientWeight FROM patients WHERE $column LIKE :search");
        $search = '%'.$searchValue.'%';
        $binds = array(
              ":search" => $search
        );
        
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

         }

         return ($results);
  }
  
  
  
  function sortPatients ($column, $order) {
      
       global $db;
        
        $results = [];
        
        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthdate, patientHeight, patientWeight FROM patients ORDER BY $column $order");
     
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
         }
         
         return ($results);
  }
  
  function getFieldNames () {
      $fieldNames = ['patientFirstName', 'patientLastName', 'patientMarried', 'patientBirthdate', 'patientHeight', 'patientWeight'];
      
      return ($fieldNames);
      
  }
?>
