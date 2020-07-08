<?php
    include_once __DIR__ . "/includes/school.php";
    $count = count($schools)
?>
<div class = "w3-section w3-card w3-margin w3-padding">
    <div> 
        <h1> Results: </h1>
        <h4> <?= $count ?> school<?php if($count>1) echo "s"; ?> matching search criteria
        
    </div>
    <table class="table table-striped w3-card">
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($schools as $row):
                    $school = new School($row['schoolName'], $row['schoolCity'], $row['schoolState']);
        ?>
        <tr>
            <td><?= $school->Name() ?></td> 
            <td><?= $school->City() ?></td>  
            <td><?= $school->State() ?></td>  
        </tr>
        <?php endforeach; ?>
    </table>
</div>