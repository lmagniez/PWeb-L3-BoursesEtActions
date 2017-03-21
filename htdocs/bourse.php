<?php
require_once("header.php");

function messageEreur(){
    if(isset($_SESSION['transaction'])){
        if($_SESSION['transaction'] != "Probleme Achat" ){
            return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> ". $_SESSION['transaction'] ." </div>";
        }
        else{
            return "<div class=\"alert alert-danger\" style=\"text-align:center;\" ><strong>Danger!</strong> ". $_SESSION['transaction'] ."</div>";
        }
    }
}

?><img class="baniere" src="./Image/bourse.jpg"  width="100%" height="300px">
<body  onload="init(); executerRequete(recupAllCSV); executerRequete(getIdsAccueil)">
   <div class="container">
      <div class="row">
        <h1 style="text-align:center;">Bourse</h1>
      </div>
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#bourse" onclick="executerRequete(getIdsAccueil)">Toute la Bourse</a></li>
          <li><a data-toggle="tab" href="#recherche" onclick="executerRequete(getIdsMarches)">Recherche</a></li>
        </ul>

      <div class="tab-content">
          <div id="bourse" class="tab-pane fade in active">
            <?php echo messageEreur(); ?>
          </div>


           <div id="recherche" class="tab-pane fade">
               <p>Le petit filtre des familles</p>

          </div>

      </div>
       
        <div id="ids"></div>
        <br/>
        <div id="element"></div>
        <div id="buttons"></div>
        <br/>
        <br/>
        <div id="chart">
			<canvas id="chart-bid" width="200" height="200"></canvas>
			<canvas id="chart-ask" width="200" height="200"></canvas>
		</div>

      
      
   
    </div> <!-- /container -->
  </body>
</html>
