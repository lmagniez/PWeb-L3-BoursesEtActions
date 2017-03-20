<?php
require_once("header.php");
?><img class="baniere" src="./Image/bourse.jpg"  width="100%" height="300px">
<body >
   <div class="container">
      <div class="row">
        <h1 style="text-align:center;">Bourse</h1>
      </div>
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#bourse">Toute la Bourse</a></li>
          <li><a data-toggle="tab" href="#recherche">Recherche</a></li>
        </ul>

      <div class="tab-content">

          <div id="bourse" class="tab-pane fade in active">
              <p>Liste de toute la bourse</p>
          </div>


           <div id="recherche" class="tab-pane fade">
               <p>Le petit filtre des familles</p>

          </div>

      </div>
   
    </div> <!-- /container -->
  </body>
</html>