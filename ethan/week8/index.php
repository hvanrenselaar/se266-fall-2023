<!DOCTYPE html>
<?php 
    $title = "Disney Votes";
    require __DIR__ . '/includes/head.php'; 
    include __DIR__ . '/models/model_disney.php'; 

    $charecters = getCharacters();
?>
<html>
    <body onload="getVotes()">
        <div class="w3-card">
            <h1 class="w3-center">Vote for your favorite Disney Charecter!</h1>     
            <div class="row row-padding">
                <?php foreach ($charecters as $temp): ?> 
                    <div class="col-sm-4 w3-center">
                        <img src="./images/<?= $temp['DisneyCharacterImage'] ?>">
                        <input type="button"  class="btn" data-character-id="<?= $temp['DisneyCharacterId'] ?>"  value="Vote for <?= $temp['DisneyCharacterName'] ?>"> </br> </br>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class ="row w3-margin-top">
                <div class="col-sm-10 col-sm-offset-1">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>
    </body>
</html>
<script>
    async function getVotes(){
        const url = 'vote.php';
        try {
            const response = await fetch(url, {
                method: 'POST'
            });
            const json = await response.json();
            UpdateChart(json);
        } catch (error) {
            console.error(error);
        } 
    }
    function UpdateChart(json){
        var ctx = document.getElementById("myChart");
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: json[0],
            datasets: [
                {
                label: "Votes",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
                data: json[1]
                }
            ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Results"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
    async function insertVote() {
        
        $disneyID = this.dataset.characterId;
        const url = 'vote.php';
        const data = { disneyID: $disneyID };

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const json = await response.json();
            UpdateChart(json);
        } catch (error) {
            console.error(error);
        }   
    }
    (function() {
        document.querySelectorAll('.btn').forEach(item => {
            item.addEventListener('click', insertVote);
        })
     })();
</script>

    
    
