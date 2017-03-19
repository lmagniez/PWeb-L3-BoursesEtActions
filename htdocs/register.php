<?php
session_start();
if(isset($_SESSION['messageConnection'])){
    if($_SESSION['messageConnection'] == "good"){
        header('Location: ./accueil.php');
        exit();
    }
}

function messageEreur(){
    if(isset($_SESSION['messageInscription'])){
        return "<div class=\"alert alert-danger\" style=\"text-align:center;\" ><strong>Danger!</strong> ". $_SESSION['messageInscription'] ."</div>";
    }
}

?><html>
	<head>
		<meta charset="utf-8"/>
		 <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="./bootstrap-3.3.7-dist/js/bootstrap.min.js" rel="stylesheet">
		 <script type="text/javascript" src="./bootstrap-3.3.7-dist/jquery-3.2.0.min.js"></script>
		 
		 <link href="./css/login.css" rel="stylesheet">
	</head>


	<body background="./Image/fond.jpg">
	 <div class="container">

      <form class="form-signin" method="post" action="./BD/BDinscription.php" style="border-radius: 20px;">
        <h2 class="form-signin-heading" style="text-align: center;">Enregistrer</h2>
        <label for="inputEmail" class="sr-only">Nom</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Nom" name="Nom" required autofocus>

        <label for="inputEmail" class="sr-only">Prenom</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Prenom" name="Prenom" required autofocus> 

        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="Mail" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required autofocus>

        <label for="inputPassword" class="sr-only">Confirmer Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Confirmer Password" name="mdpconfirm" required autofocus><br/>
        <?php echo messageEreur(); ?>
        <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Register</button><br/>
        <a class="lien" href="./login.php">Connectez vous</a>
      </form>

    </div> <!-- /container -->
	</body>
</html>
