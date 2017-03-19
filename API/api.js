
"use strict";

var index=0;
var catalogue=[];

function init(){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			catalogue = JSON.parse(xhr.responseText);
		}
	}
	xhr.open("GET", "test.json", true);
	//xhr.open("GET", "french.json", true);
	xhr.send();
	
}

function executerRequete(callback) {
	console.log('execRequete');
	if (catalogue.length === 0) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				catalogue = JSON.parse(xhr.responseText);
				if(callback)
					callback();
			}
		}
		xhr.open("GET", "test.json", true);
		//xhr.open("GET", "french.json", true);
		xhr.send();
	} else {
		if(callback)
			callback();
	}
}

function getEltBySymbole(symbole){
	
	console.log(catalogue);
	
	console.log(symbole);
	for(var i=0; i<catalogue.length; i++){
		console.log(catalogue[i].symbole);
		if(catalogue[i].symbole==symbole){
			return catalogue[i];
		}
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

function recupCSV(symbole) {
	
	
	var tmp = JSON.stringify(catalogue);
	console.log(tmp);	
	   
	  // tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
	  $.ajax({
		type: 'POST',
		url: 'recup_donnee.php',
		data: {'categories': tmp, 'symbole': symbole},
		success: function(msg) {
		  console.log(msg);
		  var value= JSON.parse(msg);
		  console.log(value);
		  
		  addDonneeToCatalogue(symbole, value[0], value[1], value[2], value[3], value[4], value[5]) 
		  
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

//créé un select comportant les différents nom des actions
//créé dans <div id=ids></div>
function getIds(){
	
	var body = document.getElementById("ids");
	
	//suppression ancienne valeur
	var del= document.getElementById("select-id");
	if(del!=null)
		body.removeChild(del);
	del=document.getElementById("button-id");
	if(del!=null)
		body.removeChild(del);
	
	
	//creation select
	var select = document.createElement("select");
	select.setAttribute("id","select-id");
	select.setAttribute("name","select-name");
	body.appendChild(select);
	
	//option
	for(var i=0; i<catalogue.length; i++) {
		
		console.log(catalogue[i].symbole);
		
		var opt=document.createElement("option");
		opt.setAttribute("value",catalogue[i].symbole);
		var txt=document.createTextNode(catalogue[i].name);
		select.appendChild(opt);
		opt.appendChild(txt);
		
	}
	
	
	var btn= document.createElement("button");
	btn.setAttribute("id","button-id");
	//btn.addEventListener("click", afficherAction(document.getElementById("select-id").value));
	
	
	
	btn.addEventListener("click", function(){afficherActionFromSelect()});
	var txt= document.createTextNode("Afficher");
	btn.appendChild(txt);
	
	

	body.appendChild(btn);
	
	
	
}

function afficherActionFromSelect(){
	var value = document.getElementById("select-id").value;
	afficherAction(value);
}

function afficherAction(symbole) {

	//recupère l'action
	var elt=getEltBySymbole(symbole);
	
	var body = document.getElementById("element");
	
	//supprime l'ancien affichage
	var del=document.getElementById("elt-content");
	if(del!=null){
		body.removeChild(del);
	}
	
	
	
	var content= document.createElement("div");
	content.setAttribute("id","elt-content");
	
	var name = document.createTextNode("Nom: "+elt.name);
	content.appendChild(name);
	var symbole = document.createTextNode("Symbole: "+elt.symbole);
	content.appendChild(symbole);
	var type = document.createTextNode("Type: "+elt.type);
	content.appendChild(type);
	
	body.appendChild(content);
	

}

init();
//executerRequete();


