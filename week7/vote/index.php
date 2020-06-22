<?php
    include (__DIR__ . '/model/model_disney.php');
    $characters = getCharacters();
    
?>


<html>
<head>
<title>Vote for your favorite Disney Character</title>
<style type="text/css">
    .main {margin-left: 100px; margin-top: 100px;}
    .character {float: left; margin-right: 10px; border: 10px solid black; padding: 0px 10px 0px 0px; width: 300px;}
    .results {float: left; margin-right: 10px; border: 1px solid black; width: 400px; margin-top: 100px;}
    .button-size {width: 200px; height: 50px;}
    .button-div {margin: 10px 0px 10px 30px;}
    h2, h3 {margin-left: 50px;}
   
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  
</head>
<body>

    <div class="main"><h1>Vote for your favorite Disney Character</h1>
        <?php foreach ($characters as $c): ?>
        <div class="character">
            <h3><?= $c['DisneyCharacterName'] ?></h3>
            <img src="./images/<?= $c['DisneyCharacterImage'] ?> ">
            <div class="button-div">
            <input type="button" 
                  class="btn btn-success button-size" 
                   data-character-id="<?= $c['DisneyCharacterId'] ?>"
                   value="Vote for <?= $c['DisneyCharacterName'] ?>">
            </div>
         </div>
        
        <?php endforeach; ?>
        <div class="results">
            <h2>Voting Results</h2>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</body>
</html>

<script>
  
   async function insertVote() {
       alert ( this.dataset.characterId);
       // put your AJAX code here!
      
    }

    async function getVotes () {
        // AJAX call to retrieve votes & display chart
    }

    (function() {
        document.querySelectorAll('.btn').forEach(item => {
        item.addEventListener('click', insertVote);
      })
      
      getVotes ();
    })();
</script>