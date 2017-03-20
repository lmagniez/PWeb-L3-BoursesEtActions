

<?php
	/*
	 * Script utilisé pour faire la communication avec l'API en demandant plusieurs actions
	 * POST -> categories:catalogue symboles:actions(ex:"GOOGL,AAPL,FB")
	 */

	if(isset($_POST['categories'])&&isset($_POST['symboles'])) {
		$json = $_POST['categories'];
		$symboles = $_POST['symboles'];
	
		
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s=GOOGL,AAPL,MSFT,FB,GC=F&f=abo");
		curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s=".$symboles."&f=abo");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$csvData = curl_exec($ch);
		//$parsed_json = json_decode($parsed_json);
		
		
		//var_dump($csvData);
		
		//$tab=str_getcsv($parsed_json," ");

		
		$lines = explode("\n", $csvData);

		$array = array();
		foreach ($lines as $line) {
			if($line!=null)
				$array[] = str_getcsv($line);
		}
		print_r($array);

		curl_close($ch);
		
		$res=json_encode($array);
		echo($res);
		
	}
?>
