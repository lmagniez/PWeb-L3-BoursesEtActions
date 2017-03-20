<?php
	/**
	 * Script utilisé pour ne récupérer qu'une action sur l'API
	 * POST -> categories:catalogue symbole:symbole API
	 */

	if(isset($_POST['categories'])&&isset($_POST['symbole'])) {
		$json = $_POST['categories'];
		$symbole = $_POST['symbole'];
		/*
		"ask":0,
		"bid":0,
		"change":0,
		"changeP":0.0,
		"date": "3/17/2017",
		"time":"4:00pm"
		*/
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s=GOOGL,AAPL,MSFT,FB,GC=F&f=abo");
		curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s=".$symbole."&f=abc1p2d1t1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$csvData = curl_exec($ch);

		$array = str_getcsv($csvData);

		curl_close($ch);
		
		$res=json_encode($array);
		echo($res);
		
	}
?>
