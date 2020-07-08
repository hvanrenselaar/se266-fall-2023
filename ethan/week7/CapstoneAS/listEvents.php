
<?php 
$title = "Events";
include_once __DIR__ . "/includes/head.php"; 
require_once __DIR__ . "/models/model_Events.php"; 


?>
<body>
    <div class="container">
        <h2 class="text-left">Events</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Starts</th>
                    <th>Ends</th>                
                    <th>Requirements</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $events = getEvents();
            foreach ($events->toArray() as $event):
                $numOfReqs = Count($event->Requirements()->toArray());
            ?>
                <tr>
                    <td>
                        <form action="editEvent.php?action=update&eventId=<?=$event->ID()?>" method="post">
                            <input type="hidden" name="eventID" value="<?php echo $event->ID(); ?>" />
                            <button class="btn glyphicon glyphicon-edit" type="submit" name="btnEdit"></button>
                            <?php echo $event->Name() ?>
                        </form>
                    </td>
                    <td> <?php echo date_format($event->EventStart(), 'm/d/y'); ?></td>
                    <td> <?php echo date_format($event->EventStart(), 'g:i A'); ?></td>
                    <td> <?php echo date_format($event->EventEnd(), 'g:i A'); ?></td>
                    <td>
                        <?php foreach ($event->Requirements()->toArray() as $req)
                        {
                            switch ($req->ReqType()){
                                case 'drink':
                                    echo ucwords($req->ReqType()) . ": " . ucwords($req->Drink()) . "<br> ";
                                break;
                                case 'brewer':
                                    echo ucwords($req->ReqType()) . ": " . ucwords($req->Brewer()) . "<br> ";
                                break;
                                case 'style':
                                    echo ucwords($req->ReqType()) . ": " . ucwords($req->Drink()) . "<br> ";
                                break;
                            }
                            
                        } ?>  
                    </td>         
                </tr>
            <?php endforeach; ?>
            <td>
            <p><a href="./editEvent.php?action=add" class="w3-btn w3-light-grey w3-margin-left">Add Event</a></p>
            </td>
            </tbody>
        </table>
    </div>
</body>

