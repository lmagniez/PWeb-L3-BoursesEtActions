<?php
require_once("header.php");
function messageEreur(){
    if(isset($_SESSION['messageUpdate'])){
        if($_SESSION['messageUpdate'] == "good" ){
            return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> Modification prise en compte </div>";
        }
        else{
            return "<div class=\"alert alert-danger\" style=\"text-align:center;\" ><strong>Danger!</strong> ". $_SESSION['messageUpdate'] ."</div>";
        }
    }
}

?><img class="baniere" src="./Image/profil.jpg"  width="100%" height="300px">
<body >
   <div class="container">
        <h1 style="text-align:center;">Profil</h1>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="mytab">
              <li><a href="#actions" data-toggle="mytab">Actions</a></li>
              <li class="active"><a href="#profil" data-toggle="mytab">Profil</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
              <div id="actions" class="tab-pane fade tabprofildiv">.Actions.</div>
              
              <div id="profil" class="tab-pane fade in active">
                <div id="elementconfig" class="row tabprofildiv">
                <?php echo messageEreur(); ?>
                  <div class="col-xs-12 col-md-7 col-md-offset-1">
                    <h4>Nom: </h4><?php echo $_SESSION["nom"]?> </br>
                    <h4>Prenom: </h4> <?php echo $_SESSION["prenom"]?></br>
                    <h4>Argent: </h4> <?php echo $_SESSION["argent"]?></br>
                    <h4>Adresse Mail</h4> <?php echo $_SESSION["mail"]?> </br>
                  </div>
                  <div class="col-xs-12 col-md-4 tabprofildiv">
                    <img class="baniere" src="./Image/avatar.png"  width="100%" height="250px">
                  </div>
                  <button class="btn btn-primary btn-lg btn-block" onClick="modification()" id="valider" type="submit">Modifier</button><br/>
                </div>
              </div>

          </div>
    </div> <!-- /container -->
  </body>
  <footer>
      <script>
      $('#mytab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      })
      </script>

      <script>
        var modif='<form class="form-signin" method="post" action="./BD/BDupdate.php" style="border-radius: 20px;">'
      +'<label for="inputEmail" class="sr-only">Nom</label> <br/><input type="text" id="inputEmail" class="form-control" placeholder="Nom"  value="<?php echo $_SESSION["nom"] ?> " name="Nom" required autofocus>'
      +'<label for="inputEmail" class="sr-only">Prenom</label> <br/><input type="text" id="inputEmail" class="form-control" placeholder="Prenom" value="<?php echo $_SESSION["prenom"]?>" name="Prenom" required autofocus>'
      +'<label for="inputEmail" class="sr-only">Email address</label> <br/><input type="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo $_SESSION["mail"]?>" name="Mail" required autofocus>'
      +'<label for="inputPassword" class="sr-only">Password</label> <br/><input type="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo $_SESSION["mdp"]?>"  name="mdp" required autofocus>'
      +'<label for="inputPassword" class="sr-only">Confirmer Password</label> <br/> <input type="password" id="inputPassword" class="form-control" placeholder="Confirmer Password" value="<?php echo $_SESSION["mdp"]?>" name="mdpconfirm" required autofocus>'
      +'<br/> <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Enregistrer Modification</button></form>';

function modification() {
  document.getElementById('elementconfig').innerHTML = modif;
}

      </script>
  </footer>
</html>

