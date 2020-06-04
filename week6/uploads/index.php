
<h2>Uploaded files</h2>
<ul>
<?php
    $files = scandir(".");
    foreach ($files as $f):
        if (strlen($f) > 2):
?>
             <li><?= $f?></li>
<?php
        endif;
    endforeach;
?>
</ul>