
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

function addDonneeToCatalogue(symbole, a, b, c, cP, d, t, reald, realt) {

	console.log(catalogue);

	var donnee= {
		ask:a,
		bid:b,
		change:c,
		changeP:cP,
		date: d,
		time: t,
		realDate: reald,
		realTime: realt
		
	};
	
	for(var i=0; i<catalogue.length; i++){
		if(catalogue[i].symbole==symbole){
			catalogue[i].données.push(donnee);
		}
	}
	loadXMLDoc();
	
}

/*
 * Vérifie si la valeur existe déjà
 * value: ask,bid,change,changeP,date,time
 */
function checkValueExists(symbole, value){

	var elt= getEltBySymbole(symbole);
	console.log(elt);
	
	var res=false;
	for(var i=0; i<elt.données.length; i++){
		res=res||(elt.données[i].ask==value[0]&&elt.données[i].bid==value[1]&&
		elt.données[i].change==value[2]&&elt.données[i].changeP==value[3]&&
		elt.données[i].date==value[4]&&elt.données[i].time==value[5]&&
		elt.données[i].realDate==value[6]&&elt.données[i].realTime==value[7]);
		console.log(res);
	}
	return res;
}


function recupCSV1(){
	console.log(">>>");
	var value = document.getElementById("select-id").value;
	console.log(value);
	recupCSV(value);
}

/*
 * Récupère dans l'api les données associées au symbole et l'ajoute au tableau json
 */
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
		  value[6]=moment().format('DD/MM');
		  value[7]=moment().format('HH:mm');
		  
		  if(!checkValueExists(symbole, value)){
			console.log('add!');
			addDonneeToCatalogue(symbole, value[0], value[1], value[2], value[3], value[4], value[5], value[6], value[7]);
			loadXMLDoc();
		  }
		  
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


/*
 * Sauvegarde le catalogue dans un fichier
 */
function loadXMLDoc() {
	
	
	var tmp = JSON.stringify(catalogue);
	console.log(tmp);	
	   
	  // tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
	  $.ajax({
		type: 'POST',
		url: 'save_categories.php',
		data: {'categories': tmp},
		success: function(msg) {
		  //alert(msg);
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

	
	executerRequete(recupCSV1());
	

	//recupère l'action
	var elt=getEltBySymbole(symbole);
	
	var body = document.getElementById("element");
	
	//supprime l'ancien affichage
	var del=document.getElementById("elt-content");
	if(del!=null){
		body.removeChild(del);
	}
	
	var body2 = document.getElementById("valider-button");
	
	//supprime l'ancien affichage
	var del=document.getElementById("achat-action");
	if(del!=null){
		body2.removeChild(del);
	}
	del=document.getElementById("vente-action");
	if(del!=null){
		body2.removeChild(del);
	}
	
	
	
	
	var content= document.createElement("div");
	content.setAttribute("id","elt-content");
	
	var name = document.createTextNode("Nom: "+elt.name);
	content.appendChild(name);
	var symbole = document.createTextNode("Symbole: "+elt.symbole);
	content.appendChild(symbole);
	var type = document.createTextNode("Type: "+elt.type);
	content.appendChild(type);
	
	
	//creation bouton
	
	var buttonAchat = document.createElement("button");
	buttonAchat.setAttribute("name","achat-action");
	buttonAchat.setAttribute("value",elt.données[elt.données.length-1].ask);
	var textB1=document.createTextNode("Acheter");
	buttonAchat.appendChild(textB1);
	content.appendChild(buttonAchat);
	
	var buttonVente = document.createElement("button");
	buttonVente.setAttribute("name","vente-action");
	buttonVente.setAttribute("value",elt.données[elt.données.length-1].bid);
	var textB2=document.createTextNode("Vendre");
	buttonVente.appendChild(textB2);
	content.appendChild(buttonVente);
	
	
	body.appendChild(content);
	body.appendChild(content2);
	
	
	graph(elt);
	
	

}
var today = moment().format('D MM, YYYY, HH:mm');
console.log("today"+today);
init();
//executerRequete();



function graph(elt){

	var body = document.getElementById("chart");
	
	//suppression ancienne valeur
	var del= document.getElementById("chart-bid");
	if(del!=null)
		body.removeChild(del);
	del= document.getElementById("chart-ask");
	if(del!=null)
		body.removeChild(del);
	
	//creation select
	var canv = document.createElement("canvas");
	canv.setAttribute("width","100");
	canv.setAttribute("height","100");
	canv.setAttribute("id","chart-bid");
	body.appendChild(canv);
	var canv2 = document.createElement("canvas");
	canv2.setAttribute("width","100");
	canv2.setAttribute("height","100");
	canv2.setAttribute("id","chart-ask");
	body.appendChild(canv2);
	
	

	var date=[];
	var bid=[];
	var ask=[];
	
	for(var i=0; i<elt.données.length; i++){
		date.push(elt.données[i].realDate +" "+ elt.données[i].realTime);
		bid.push(elt.données[i].bid);
		ask.push(elt.données[i].ask);
		
	}
	
	console.log(date);
	console.log(bid);
	
	 

	Chart.defaults.global.maintainAspectRatio = false;
	Chart.defaults.global.lineTension = 0;
	Chart.defaults.global.bezierCurve = false;
	Chart.defaults.global.animationSteps = 50;
	Chart.defaults.global.tooltipYPadding = 16;
	Chart.defaults.global.tooltipCornerRadius = 0;
	Chart.defaults.global.tooltipTitleFontStyle = "normal";
	Chart.defaults.global.tooltipFillColor = "rgba(0,160,0,0.8)";
	Chart.defaults.global.animationEasing = "easeOutBounce";
	Chart.defaults.global.responsive = true;
	Chart.defaults.global.scaleLineColor = "black";
	Chart.defaults.global.scaleFontSize = 16;
	
	var lineChartDataBid = {
    //labels: ["Data 1", "Data 2", "Data 3", "Data 4", "Data 5", "Data 6", "Data 7"],
    labels: date,
    datasets: [{
        fillColor: "rgba(220,220,220,0)",
        strokeColor: "rgba(220,180,0,1)",
        pointColor: "rgba(220,180,0,1)",
        data: bid

    }
    ]

	}
	
	var lineChartDataAsk = {
    labels: date,
    datasets: [{
        fillColor: "rgba(151,187,205,0)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        data: ask
    }
    ]

	}

	

	var ctx = document.getElementById("chart-bid").getContext("2d");
	
	var LineChartBid = new Chart(ctx).Line(lineChartDataBid, {
		pointDotRadius: 10,
		bezierCurve: false,
		scaleShowVerticalLines: false,
		scaleGridLineColor: "black"
	});
	
	
	var ctx = document.getElementById("chart-ask").getContext("2d");
	
	var LineChartAsk = new Chart(ctx).Line(lineChartDataAsk, {
		pointDotRadius: 10,
		bezierCurve: false,
		scaleShowVerticalLines: false,
		scaleGridLineColor: "black"
	});
	
	
	
	
}


