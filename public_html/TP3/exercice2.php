
<?php

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

		if(isset($_POST["colortxt"])&&isset($_POST["colorbg"]))
		{
			setcookie("colortxt", $_POST["colortxt"], time()+36000);
			setcookie("colorbg", $_POST["colorbg"], time()+36000);

		}

		if(!empty($_POST))
		{
			header("Location:".$_SERVER['REQUEST_URI']);
		}


		/*
		var_dump($_POST);
		echo "<br>";
		var_dump($_COOKIE);


		echo "<pre>";
		var_dump($_SERVER);
		echo "</pre>";
		*/



		//header


	}

	function getPage()
	{
		if(isset($_COOKIE["page"]))
			echo $_COOKIE["page"];
		else echo "./exercice2.php";
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

	<style>
	body {
		<?php if(isset($_COOKIE["colorbg"]))echo "background-color:".$_COOKIE["colorbg"].";" ?>
		<?php if(isset($_COOKIE["colortxt"]))echo "color:".$_COOKIE["colortxt"].";" ?>
		}
	</style>

	<body>
		<p>
			<?php afficherCookie(); ?>

		<form action="./exercice2.php">
				<input type="submit" value="Actualiser la page" />
			</form>

			<form action="<?php getPage()?>">
				<input type="submit" value="Connexion" />
			</form>


			<form method="post" action="exercice2.php">

			<fieldset >
				<legend>Saisie du nom</legend>
				Nom: <br>
				<input type="text" name="nom" value="<?php is_set("nom");?>"><br>
				Prenom: <br>
				<input type="text" name="prenom" value="<?php is_set("prenom");?>"><br>
				Civilite: <br>
				<select name="civilite">
					<option value="M."  <?php is_setCombo("civilite",'M.');?>> M.</option>
					<option value="Mme" <?php is_setCombo("civilite",'Mme'); ?>> Mme</option>
					<option value="Melle" <?php is_setCombo("civilite",'Melle'); ?>> Melle</option>
				</select>
				<br>



				Page préférée: <br>
				<input type="text" name="page" value="<?php is_set("page");?>"><br>
				<br>
				Couleur fond:
				<input type="color" name="colorbg" value="<?php is_set("colorbg");?>"><br>
				Couleur text:
				<input type="color" name="colortxt" value="<?php is_set("colortxt");?>"><br>

				<br>
				<input type="submit" name="submit" value="Valider"><br>

			</fieldset>

		</form>

		</p>
	</body>
</html>
