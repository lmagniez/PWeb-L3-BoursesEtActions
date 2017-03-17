
<?php

	function make_tab()
	{
		if(isset($_POST["submit"]))
		{
			$tab="<table>\n";
			$tab.="<tr><th>tableau</th></tr>";
			
			
			foreach($_POST as $k=>$v)
				$tab.="<tr><td> champ ".$k."</td><td>".$v."</td></tr>";
			
			$tab.="</table>";
			
			return $tab;
			
		}
		else echo 'pas de formulaire envoyé';
	}
?>

<html>

	<head>
		<meta charset="utf-8"/>
	</head>
	
	<body>
		
		<?php 
			echo make_tab();
		?>
		
	</body>

</html>
