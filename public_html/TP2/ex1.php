<?php

?>


<html>

	<head>
		<meta charset="utf-8"/>
	</head>
	
	<body>
	
		<form method="post" action="ex1_traitement.php">
		
			<fieldset >
				<legend>Adresse client</legend>
				Nom: <br/>
				<input type="text" name="name" value="Nom" /><br/>
				Prénom: <br/>
				<input type="text" name="surname" value="Prénom" /><br/>
				Adresse: <br/>
				<input type="text" name="adress" value="Adresse" /><br/>
				Ville: <br/>
				<input type="text" name="city" value="Ville" /><br/>
				Code Postal<br/>
				<input type="number" name="postcode" value="00000" /><br/>
				<br/>
				<input type="submit" name="submit" value="Envoyer"/><br/>
			</fieldset>
		
		</form>
	
	
	</body>


</html>
