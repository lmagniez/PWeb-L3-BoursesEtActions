
<?php

	function calcul()
	{
		if(isset($_POST["submit"]))
		{
			$res=16400+$_POST["moteur"]+$_POST["porte"];
			if(isset($_POST["clim"]))
				$res=$res+$_POST["clim"];
			if(isset($_POST["metal"]))
				$res=$res+$_POST["metal"];
			if(isset($_POST["radio"]))
				$res=$res+$_POST["radio"];

			return $res;

		}
	}

	function controleMoteur($value)
	{
		 if($_POST["moteur"]==$value)echo "selected= 'selected'";
	}

	function controlePorte($value)
	{
		if($_POST["porte"]==$value)echo "checked='checked'";
	}

	function controleOption($nom)
	{
		if(isset($_POST[$nom]))echo "checked='checked'";
	}

?>

<html>

	<head>
		<meta charset="utf-8">
	</head>

	<body>


		<form method="post" action="ex4.php" enctype="multipart/form-data">

			<fieldset>
				<legend>Calcul prix d'une voiture</legend>
				<b>Motorisation</b><br>

				<select name="moteur">
					<option value="0"
					<?php controleMoteur(0) ?>
					> essence 1.2 </opt>
					<option value="2000"
					<?php controleMoteur(2000) ?>
					> essence 1.6 (+2000€)</opt>
					<option value="3000"
					<?php controleMoteur(3000) ?>
					> DCI (+3000€)</opt>
				</select>
				<br><br>

				<b>Type de voiture</b><br>
				<input type="radio" name="porte"
				<?php controlePorte(0); ?>
				value="0">3 portes

				<input type="radio" name="porte"
				<?php controlePorte(1000); ?>
				value="1000">5 portes (+1000€)
				<br><br>

				<b>Options</b> <br>
				<input type="checkbox" name="clim" value="2000"
				<?php controleOption("clim")?>>
				Climatisation (+2000€) <br>
				<input type="checkbox" name="metal" value="300"
				<?php controleOption("metal")?>>
				Peinture métalisée (+300€) <br>
				<input type="checkbox" name="radio" value="100"
				<?php controleOption("radio")?>>
				Auto-radio CD <br>

				<br>
				<input type="submit" name="submit"/><br>


			</fieldset>

		</form>

		<fieldset >
			<legend>Le prix</legend>
			Prix:
			<input type="text" name="reception" value="<?php echo calcul() ?>" readonly="true"><br>

		</fieldset>



	</body>


</html>

