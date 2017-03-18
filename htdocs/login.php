<?php
session_start();

function messageEreur(){
    if(isset($_SESSION['messageConnection'])){
        if($_SESSION['messageConnection'] == "good" ){
            return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> ". $_SESSION['messageConnection'] ."</div>";
        }
        if($_SESSION['messageConnection'] == "Inscription Reussie" ){
            return "<div class=\"alert alert-success\" style=\"text-align:center;\"><strong>Success!</strong> ". $_SESSION['messageConnection'] ."</div>";
        }
        else{
            return "<div class=\"alert alert-danger\" style=\"text-align:center;\" ><strong>Danger!</strong> ". $_SESSION['messageConnection'] ."</div>";
        }
    }
}
?><html>
	<head>
		<meta charset="utf-8"/>
		 <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="./bootstrap-3.3.7-dist/js/bootstrap.min.js" rel="stylesheet">
		 <link href="./css/login.css" rel="stylesheet">
	</head>


	<body >
	 <div class="container">
      <form class="form-signin" method="post" action="./BD/BDLogin.php" >
        <h2 class="form-signin-heading" style="text-align: center;">Connection</h2>
        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="Mail" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required><br/>

        <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Sign in</button><br/>
        <?php echo messageEreur(); ?>
        <a class="lien" href="./register.php">Enregistrez vous</a>
      </form>
    </div> <!-- /container -->
	</body>
</html>
