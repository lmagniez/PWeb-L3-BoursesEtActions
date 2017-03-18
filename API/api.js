
"use strict";

var index=0;
var catalogue=[];

function executerRequete(callback) {
	if (catalogue.length === 0) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				catalogue = JSON.parse(xhr.responseText);
				callback();
			}
		}
		xhr.open("GET", "api.json", true);
		//xhr.open("GET", "french.json", true);
		xhr.send();
	} else {
		callback();
	}
}

function addDonneeToCatalogue(symbole, a, b, c, cP, d, t) {

	console.log(catalogue);

	var donnee= {
		ask:a,
		bid:b,
		change:c,
		changeP:cP,
		date: d,
		time: t
		
	};
	
	for(var i=0; i<catalogue.length; i++){
		if(catalogue[i].symbole==symbole){
			catalogue[i].données.push(donnee);
		}
	}
	loadXMLDoc();
	
}

function loadXMLDoc() {
	
	
	var tmp = JSON.stringify(catalogue);
	console.log(tmp);	
	   
	  // tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
	  $.ajax({
		type: 'POST',
		url: 'save_categories.php',
		data: {'categories': tmp},
		success: function(msg) {
		  alert(msg);
		},
    
		error : function(resultat, statut, erreur){
			console.log("error");
			console.log(resultat);
			console.log(statut);
			console.log(erreur);
		
		},

		complete : function(resultat, statut){
			console.log("complete");

		}
	  });
	
	
}



function lireSuivant() {
	var longueur = catalogue.length;
	console.log(catalogue[index]);
	console.log(longueur);

	if (index < longueur - 1) {
		index++;
	}
}

function lireJoueurs() {

	console.log(catalogue);
	/*
	var body = document.getElementById("equipe");


	var table = document.createElement("table");
	table.setAttribute("id","tabJoueur");
	body.appendChild(table);

	for(var i=0; i<16; i++) {
		console.log(catalogue[index].players[i].name);

		var ligne = document.createElement("tr");
		var cell = document.createElement("td");
		var cell2 = document.createElement("td");
		var nom = document.createTextNode(catalogue[index].players[i].name);

		var nom2 = document.createTextNode(catalogue[index].players[i].name);

		table.appendChild(ligne);
		ligne.appendChild(cell);
		ligne.appendChild(cell2);
		cell.appendChild(nom);
		cell2.appendChild(nom2);


	}
	*/
}

function lirePrecedent() {
	console.log(catalogue[index]);
	if (index > 0) {
		index--;
	}
}

executerRequete(lireSuivant);
executerRequete(lireSuivant);

