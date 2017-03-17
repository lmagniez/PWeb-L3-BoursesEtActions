
<?php


	function afficherCookie()
	{

	}

	function incrementCookie($nom_cookie)
	{
		if (isset($_COOKIE[$nom_cookie]))
		{
			setcookie("$nom_cookie", $_COOKIE[$nom_cookie]+1, time()+36000);
		}
		else
		{
			setcookie("$nom_cookie", 0, time()+36000);
		}
	}


	function is_set($value)
	{
		if(isset($_COOKIE[$value]))echo $_COOKIE[$value];
	}

	function is_setCombo($name, $value)
	{
		if($_COOKIE["$name"]==$value)echo "selected=selected";
	}


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
        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Nom" required autofocus>

        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="text" id="inputEmail" class="form-control" placeholder="Prenom" required autofocus> <br/>

		<input type="date" class="form-control" name="anniversaire" placeholder="" required autofocus>

        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>

        <label for="inputPassword" class="sr-only">Confirmer Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Confirmer Password" required><br/>

        <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Sign in</button>
        <a class="lien" href="./login.php">Connectez vous</a>
      </form>

    </div> <!-- /container -->
	</body>
</html>
