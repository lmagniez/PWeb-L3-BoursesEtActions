

<?php

//http://wern-ancheta.com/blog/2015/04/05/getting-started-with-the-yahoo-finance-api/
//https://fr.finance.yahoo.com/lookup?s=a
//http://www.jarloo.com/yahoo_finance/

//graphique récapitulatif
//bénéfice
//données financiere

//marchés (cac 40, EUR/USD...)
//actions (APPLE, FB...)

//Cotation 5029,24 (+0,32%)
//+HAUT, +BAS, Ouverture, Cloture veille

//v: volume: Nombre de titres échangés au cours d’une séance de Bourse ou d’une transaction.
//a5: ask size
//b6: bid size
//capitalisation boursiere
//objectif sur 1 un

//y: Rendement (divident yield) : En théorie, plus le rendement net est élevé, plus l'investissement est avantageux.
//ba: Le bid est moins élevé que le ask. Du côté sell side le bid correspond au prix d'achat et le ask au prix de vente.
//c1: Change c1
//p2: change pourcent p2

function recupCSV($symbole){

	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s=GOOGL,AAPL,MSFT,FB,GC=F&f=abo");
	curl_setopt($ch, CURLOPT_URL, "http://finance.yahoo.com/d/quotes.csv?s="+symbole+"&f=abo");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
	$csvData = curl_exec($ch);
	//$parsed_json = json_decode($parsed_json);

	var_dump($csvData);
	echo '
	';
	//$tab=str_getcsv($parsed_json," ");

	$lines = explode("\n", $csvData);

	$array = array();
	foreach ($lines as $line) {
		$array[] = str_getcsv($line);
	}
	print_r($array);

	curl_close($ch);

	echo "ok";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Jeux</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js"></script>
	</head>
	
	
	<body onload="executerRequete(getIds)">
        <section  class="container">
            <article name="données" class="well form-inline pull-left col-lg-5">
				<script type="text/javascript" src="api.js"></script>
                
                
                <button class="btn btn-primary" type="submit" onclick="executerRequete(getIds)">
				<span class="glyphicon glyphicon-step-backward"> 
				</span> Récup Ids</button>

				<button class="btn btn-primary" type="submit" 
				onclick="executerRequete(afficherAction('FB'))">
				<span class="glyphicon glyphicon-step-backward"> 
				</span> Récup FB</button>
				
				<button class="btn btn-primary" type="submit" 
				onclick="executerRequete(addDonneeToCatalogue('FB', 3, 3, 3, 4, '3/03/3123', '3:00pm'))">
				<span class="glyphicon glyphicon-step-backward"> 
				</span> Test save </button>
				
				<button class="btn btn-primary" type="submit" 
				onclick="executerRequete(recupCSV1())">
				<span class="glyphicon glyphicon-step-backward"> 
				</span> Test Requete </button>
				
				
				
				



            </article>
        </section>

        
        
        
        <div id="ids">

        </div>
        
        <div id="element">

        </div>
        
        <div id="chart">
			<canvas id="chart-bid" width="100" height="100"></canvas>
			<canvas id="chart-ask" width="100" height="100"></canvas>
		</div>
        
        

    </body>
</html>
