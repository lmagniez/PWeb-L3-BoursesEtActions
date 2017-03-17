
<?php
	session_start();
	updateInfo();
	incrementCookie("nb_visite");



	function afficherCookie()
	{
		if(isset($_COOKIE["nom"])&&isset($_COOKIE["prenom"])&&isset($_COOKIE["civilite"]))
			echo 'bonjour '.$_COOKIE["civilite"].' '.$_COOKIE["nom"].' '.$_COOKIE["prenom"].'<br>';

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

		if(isset($_POST["nom"])&&isset($_POST["prenom"])&&isset($_POST["civilite"]))
		{
			setcookie("civilite", $_POST["civilite"], time()+36000);
			setcookie("nom", $_POST["nom"], time()+36000);
			setcookie("prenom", $_POST["prenom"], time()+36000);

		}
		if(isset($_POST["page"]))
		{
			setcookie("page", $_POST["page"], time()+36000);
		}

	}

	function getPage()
	{
		if(isset($_COOKIE["page"]))
			echo $_COOKIE["page"];
		else echo "./exercice1.php";
	}

?>
<html>
	<head>
		<meta charset="utf-8"/>
	</head>

	<body>
		<p>
			<?php afficherCookie(); ?>

			<form action="./exercice1.php">
				<input type="submit" value="Actualiser la page" />
			</form>

			<form action="<?php getPage()?>">
				<input type="submit" value="Connexion" />
			</form>


			<form method="post" action="exercice1.php">

			<fieldset >
				<legend>Saisie du nom</legend>
				Nom: <br>
				<input type="text" name="nom" value=<?php if(isset($_COOKIE["nom"]))echo $_COOKIE["nom"]?>><br>
				Prenom: <br>
				<input type="text" name="prenom" value=<?php if(isset($_COOKIE["prenom"]))echo $_COOKIE["prenom"]?>><br>
				Civilite: <br>
				<select name="civilite">
					<option value="M."  <?php if($_COOKIE["civilite"]=='M.')echo "selected=selected";?>> M.</option>
					<option value="Mme" <?php if($_COOKIE["civilite"]=='Mme')echo "selected=selected";?>> Mme</option>
					<option value="Melle" <?php if($_COOKIE["civilite"]=='Melle')echo "selected=selected";?>> Melle</option>
				</select>
				<br>
				Page préférée: <br>
				<input type="text" name="page" value=<?php if(isset($_COOKIE["page"]))echo $_COOKIE["page"]?>><br>



				<br>
				<input type="submit" name="submit" value="Valider"><br>

			</fieldset>

		</form>

		</p>
	</body>
</html>
