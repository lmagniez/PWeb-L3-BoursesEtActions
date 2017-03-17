<?php

	function afficherTVA()
	{
		
		if(isset($_POST["submit"]))
		{
			$prixHT=$_POST["ht"];
			$tauxTVA=$_POST["tva"];
			return $prixHT*($tauxTVA/100);
		}
		
	}
	
	function afficherPrixTTC()
	{
		
		if(isset($_POST["submit"]))
		{
			$prixHT=$_POST["ht"];
			$tauxTVA=$_POST["tva"];
			return $prixHT-$prixHT*($tauxTVA/100);
		}
		
	}
	
	
	
?>


<html>

	<head>
		<meta charset="utf-8"/>
	</head>
	
	<body>
	
	
		<form method="post" action="ex2.php">
		
			<fieldset >
				<legend>Calcul du prix</legend>
				Prix HT: <br>
				<input type="number" name="ht" value=<?php echo $_POST["ht"]?>><br>
				Taux TVA: <br>
				<input type="number" name="tva" value=<?php echo $_POST["tva"]?>><br>
				<br>
				<input type="submit" name="submit" value="Valider"><br>
				
			</fieldset>
		
		</form>
		
		<fieldset >
			<legend>TVA</legend>
			Valeur TVA: <br>
			<input type="text" name="tauxtva" readonly=readonly  value="<?php echo afficherTVA() ?>" ><br>
			Prix TTC: <br>
			<input type="text" name="ttc" value=" <?php echo afficherPrixTTC() ?>" readonly=readonly   ><br>
		
		</fieldset>
		
		
		
	</body>


</html>
