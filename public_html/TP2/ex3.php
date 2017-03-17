<?php




	moveArchive();
	//echo sys_get_temp_dir();

	function moveArchive()
	{
		if(isset($_POST["submit"]))
		{

			var_dump($_FILES["zip"]["name"]);
			if (move_uploaded_file($_FILES["zip"]["tmp_name"],sys_get_temp_dir()."/vincent_valembois/").$_FILES["zip"]["name"])
				return "transfert effectué";
			else
				return "echec du transfert";

		}
	}

	function afficherNom()
	{

		if(isset($_POST["submit"]))
		{
			return $_FILES["zip"]["tmp_name"];
		}

	}

	function afficherTaille()
	{

		if(isset($_POST["submit"]))
		{
			return $_FILES["zip"]["size"];
		}

	}



?>


<html>

	<head>
		<meta charset="utf-8">
	</head>

	<body>


		<form method="post" action="ex3.php" enctype="multipart/form-data">

			<fieldset>
				<legend>Upload d'archive</legend>
				Archive ZIP: <br>

				<input type="hidden" name="MAX_FILE_SIZE" value="12345" />
				<input type="file" name="zip"/><br>
				<input type="submit" name="submit"/><br>


			</fieldset>

		</form>

		<fieldset >
			<legend>Info Zip</legend>
			Réception:
			<input type="text" name="reception" value="<?php echo moveArchive() ?>" readonly="true"><br>
			Nom: <br>
			<input type="text" name="name" value="<?php echo afficherNom() ?>" readonly="true"><br>
			Taille: <br>
			<input type="text" name="size" value="<?php echo afficherTaille() ?>" readonly="true"><br>
		</fieldset>



	</body>


</html>
