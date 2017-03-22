<?php
require_once("header.php");

function messageEreurProfil(){
    if(isset($_SESSION['messageUpdate'])){
        if($_SESSION['messageUpdate'] == "good" ){
            return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> Modification prise en compte </div>";
        }
        else{
            return "<div class=\"alert alert-danger\" style=\"text-align:center;\" ><strong>Danger!</strong> ". $_SESSION['messageUpdate'] ."</div>";
        }
    }
}

function messageEreurAction(){
    if(isset($_SESSION['transaction'])){
          return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> ".$_SESSION['transaction']." </div>";
    }
}

$actionsUser=array();
$strResult;
$donneeUtilisateur;

function gererActionsUser(){
	global $strResult;
	global $actionsUser;
	global $donneeUtilisateur;

	$strResult="[";

	if(isset($_SESSION["actions"])){
		$donneeUtilisateur=json_encode($_SESSION["actions"]);
		foreach ($_SESSION["actions"] as $action){
			array_push($actionsUser,$action["nomAction"]);
			$strResult.="'".$action["nomAction"]."',";

		}
		//commandes

		var_dump($actionsUser);

	}
	$strResult=substr($strResult, 0, -1);
	$strResult.="]";


	$donneeUtilisateur=str_replace("\"","'",$donneeUtilisateur);
}

gererActionsUser();


?>

<img class="baniere" src="./Image/profil.jpg"  width="100%" height="300px">
<body onload="init(); executerRequete(recupAllCSV); executerRequete(getIdsPerso(<?php echo $strResult.',';echo $donneeUtilisateur; ?>))" >
   <div class="container">
        <h1 style="text-align:center;">Mon Compte</h1>
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#actions">Action</a></li>
          <li><a data-toggle="tab" href="#profil">Profil</a></li>
        </ul>

      <div class="tab-content">
          <div id="actions" class="tab-pane fade in active">

              <?php echo messageEreurAction(); ?>
				<div id="ids"></div>
				<br/>
				<div id="element"></div>
				<div id="buttons"></div>
				<br/>
				<br/>
				<div id="chart" style="width:600px; height:350px;">
					<canvas id="chart-bid"></canvas>
					<canvas id="chart-ask"></canvas>
				</div>


          </div>


           <div id="profil" class="tab-pane fade">
              <div id="elementconfig" class="row tabprofildiv">
                  <?php echo messageEreurProfil(); ?>
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
        var modif='<form class="form-signin" method="post" action="./BD/.BDupdate.php" style="border-radius: 20px;">'
      +'<label for="inputNom" class="sr-only">Nom</label> <br/><input type="text" id="inputEmail" class="form-control" placeholder="Nom"  value="<?php echo $_SESSION["nom"] ?> " name="Nom" required autofocus>'
      +'<label for="inputPrenom" class="sr-only">Prenom</label> <br/><input type="text" id="inputEmail" class="form-control" placeholder="Prenom" value="<?php echo $_SESSION["prenom"]?>" name="Prenom" required autofocus>'
      +'<label for="inputEmail" class="sr-only">Email address</label> <br/><input type="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo $_SESSION["mail"]?>" name="Mail" required autofocus>'
      +'<label for="inputPassword" class="sr-only">Password</label> <br/><input type="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo $_SESSION["mdp"]?>"  name="mdp" required autofocus>'
      +'<label for="inputPassword" class="sr-only">Confirmer Password</label> <br/> <input type="password" id="inputPassword" class="form-control" placeholder="Confirmer Password" value="<?php echo $_SESSION["mdp"]?>" name="mdpconfirm" required autofocus>'
      +'<label for="inputArgent" class="sr-only">Ajout Argent</label><br/> <input type="number" class="form-control"  name="somme" placeholder="Ajout Argent" min="<?php echo $_SESSION["argent"]?>" value="<?php echo $_SESSION["argent"]?>" required/>'
      +'<br/> <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Enregistrer Modification</button></form>';



function modification() {
  document.getElementById('elementconfig').innerHTML = modif;
}
  </script>
  </footer>
</html>
