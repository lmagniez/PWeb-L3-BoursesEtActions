
<?php

	incrementCookie("nb_visite");


	function afficherCookie()
	{
		if(isset($_COOKIE["pseudo"])&&isset($_COOKIE["color-pseudo"]))
			echo 'bonjour '.$_COOKIE["pseudo"].' '.$_COOKIE["color-pseudo"].'<br>';

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

			<form method="post" action="message.php">

			<fieldset >
				<legend>Saisie du nom</legend>
				Pseudo: <br>
				<input type="text" name="pseudo" value="<?php is_set("pseudo");?>"><br>
				<br>

				Couleur pseudo:
				<input type="color" name="color-pseudo" value="<?php is_set("colorbg");?>"><br>

				<br>
				<input type="submit" name="submit" value="Valider"><br>

			</fieldset>

		</form>

		</p>
	</body>
</html>
