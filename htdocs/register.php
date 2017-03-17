<?php
?>
<html>
	<head>
		<meta charset="utf-8"/>
		 <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="./bootstrap-3.3.7-dist/js/bootstrap.min.js" rel="stylesheet">
		 <script type="text/javascript" src="./bootstrap-3.3.7-dist/jquery-3.2.0.min.js"></script>
		 
		 <link href="./css/login.css" rel="stylesheet">
	</head>


	<body >
	 <div class="container">

      <form class="form-signin" method="post" action="#" >
        <h2 class="form-signin-heading" style="text-align: center;">Enregistrer</h2>
        <label for="inputEmail" class="sr-only">Nom</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Nom" name="Nom" required autofocus>

        <label for="inputEmail" class="sr-only">Prenom</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Prenom" name="Prenom" required autofocus> 

        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="Mail" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pws1" required autofocus>

        <label for="inputPassword" class="sr-only">Confirmer Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Confirmer Password" rname="pws2" equired><br/>

        <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Register</button><br/>
        <a class="lien" href="./login.php">Connectez vous</a>
      </form>

    </div> <!-- /container -->
	</body>
</html>
