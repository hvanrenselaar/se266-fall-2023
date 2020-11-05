<?php

    include (__DIR__ . '/db.php');
    
    
    function getPatients () {
        global $db;
        
        $results = [];

        $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY patientLastName"); 
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }
    

    
    function addPatient ($f, $l, $m, $b) {
        global $db;
        $results = "Not added";

        $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :pFName, patientLastName = :pLName, patientMarried = :pMarried, patientBirthDate = :pBDate");

        $binds = array(
            ":pFName" => $f,
            ":pLName" => $l,
            ":pMarried" => $m,
            ":pBDate" => $b
        );
        
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = 'Data Added';
        }
        
        return ($results);
    }
   
    function addPatient2 ($f, $l, $m, $b) {
        global $db;
        $results = "Not added";

        $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :pFName, patientLastName = :pLName, patientMarried = :pMarried, patientBirthDate = :pBDate");
       
        $stmt->bindValue(':pFName', $f);
        $stmt->bindValue(':pLName', $l);
        $stmt->bindValue(':pMarried', $m);
        $stmt->bindValue(':pBDate', $b);
       
        
        
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = 'Data Added';
        }
       
        $stmt->closeCursor();
       
        return ($results);
    }
   
    
  
    

?>
