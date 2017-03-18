
<?php

	updateInfo();
	incrementCookie("nb_visite");

	function afficherCookie()
	{
		if(isset($_COOKIE["login"]))
			echo 'bonjour '.$_COOKIE["login"].'<br>';

		if (isset($_COOKIE["nb_visite"]))
			echo 'Nombre de visites : ' . $_COOKIE["nb_visite"] . '!<br />';
		else
			echo 'Le cookie n\'existe pas <br />';

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

	function updateInfo()
	{

		if(!session_id())
			session_start();
		if(!isset($_SESSION['logins'])
			$_SESSION['login']=$_POST['login']

		if(isset($_POST["login"])&&isset($_POST["mdp"]))
		{
			setcookie("civilite", $_POST["civilite"], time()+36000);
			setcookie("nom", $_POST["nom"], time()+36000);
			setcookie("prenom", $_POST["prenom"], time()+36000);
		}
	}

	function getPage()
	{
		if(isset($_COOKIE["page"]))
			echo $_COOKIE["page"];
		else echo "./exercice1.php";
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
	</head>

	<body>
		<p>
			<?php afficherCookie(); ?>

		<form action="./exercice3.php">
			<input type="submit" value="Actualiser la page" />
		</form>

		<form method="post" action="exercice2-2.php">

			<fieldset>
				<legend>Inscription</legend>
				login: <br>
				<input type="text" name="login"><br>

				MDP: <br>
				<input type="text" name="mdp"><br>

				<br>
				<input type="submit" name="submit" value="Inscrire"><br>

			</fieldset>

		</form>



		<form method="post" action="exercice2-2.php">

			<fieldset>
				<legend>Connexion</legend>
				login: <br>
				<input type="text" name="connectlogin" ><br>

				MDP: <br>
				<input type="text" name="connectmdp" ><br>


				<input type="submit" name="submit" value="Connexion"><br>

			</fieldset>

		</form>

		</p>
	</body>
</html>
