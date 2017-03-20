<?php
require_once("header.php");
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
              <p>Liste de toute la bourse</p>
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
