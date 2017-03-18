
<?php



	$dsn = "sqlite:BDD.sqlite3" ;
	$pdo = new PDO($dsn);
	if(!$pdo) echo 'Erreur connection bdd';
	$querySelect = 'SELECT * from message;';

	function recuperer(){
		 global $pdo;
		 global $querySelect;
		 $prep = $pdo->prepare($querySelect);
		 $prep->execute();
		 #print_r($prep->fetchAll());

		while ($row = $prep->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$str = '<p style="color:'.$row[3].'">'.$row[1].': '.$row[2].'</p>';
			echo $str;
		}
		 //echo $prep;
	}





	if(isset($_POST["message"]))
			echo $_POST["message"];

	//var_dump($_POST);
	//var_dump($_COOKIE);


	updateInfo();
	incrementCookie("nb_visite");


	function afficherCookie()
	{
		if(isset($_COOKIE["pseudo"])&&isset($_COOKIE["color-pseudo"]))
			echo '<p style="color:'.$_COOKIE["color-pseudo"].'">bonjour '.$_COOKIE["pseudo"].' ('.$_COOKIE["color-pseudo"].')</p>';

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

		//session_start();


		/*
		if(isset($_COOKIE["pseudo"])&&isset($_COOKIE["color-pseudo"]))
		{
			$_SESSION["pseudo"]=$_COOKIE["pseudo"];
			$_SESSION["color-pseudo"]=$_COOKIE["color-pseudo"];
		}*/




		if(!empty($_POST))
		{
			if(isset($_POST["pseudo"])&&isset($_POST["color-pseudo"]))
			{
				setcookie("pseudo", $_POST["pseudo"], time()+36000);
				setcookie("color-pseudo", $_POST["color-pseudo"], time()+36000);
			}


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

		<?php recuperer(); ?>

		<p>
			<?php afficherCookie(); ?>

		<form method="post" action="BD.php">

			<fieldset>
				<legend>Saisie du Message</legend>

				Pseudo: <?php is_set("pseudo") ?> <br>
				<input type="hidden" name="pseudo" value="<?php is_set("pseudo") ?>">
				<input type="hidden" name="color-pseudo" value="<?php is_set("color-pseudo") ?>">


				<input type="text" name="message" value="text"><br>

				<input type="submit" name="submit" value="Valider"><br>


			</fieldset>

		</form>

		</p>
	</body>
</html>
