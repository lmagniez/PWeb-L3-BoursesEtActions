
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
		xhr.open("GET", "french.json", true);
		xhr.send();
	} else {
		callback();
	}
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


/*
	var pNode = document.createElement("p");
	pNode.setAttribute("id","P1");
	var txtNode = document.createTextNode('Totor le Castor');
	var body = document.getElementById("equipe"); // fonctionne sur n'importe quel nœud
	var  h1Node = document.createElement('h1');
	body.appendChild(pNode);
	pNode.appendChild(txtNode);
	body.insertBefore(h1Node, pNode);
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


/*
//var obj = JSON.parse(text);

// Création d'un objet XMLHttpRequest
var req = new XMLHttpRequest();
// Appel d'une méthode en mode Synchrone
// DEPRECATED
req.open('GET', '/data/french.json', true);
// envoi du corps de la requête
req.send(null);
// test du retour
if(req.status == 200){
  dump(req.responseText);
  catalogue= JSON.parse(xhr.responseText);
  callback();
}

console.log("ok");


/*
var xhr = new XMLHttpRequest();
xhr.open('GET', 'french.json', true);
xhr.onreadystatechange = function (aEvt) {
    if (xhr.readyState == 4) {

		if(xhr.status == 200){
			dump(xhr.responseText);
			catalogue= JSON.parse(xhr.responseText);
			callback();
		}
	}
    else
      dump("Erreur pendant le chargement de la page.\n");

};
xhr.send();

function onProgress(e) {
  var percentComplete = (e.position / e.totalSize)*100;
}

function onError(e) {
  alert("Une erreur " + e.target.status + " s'est produite au cours de la réception du document.");
}




/*

function Point(x, y) {
    this.x = x;
    this.y = y;
}


function Vecteur2D(p1, p2) {
    this.p1 = p1;
    this.p2 = p2;
    this.vx = p2.x - p1.x;
    this.vy = p2.y - p1.y;
}

Vecteur2D.prototype.add = function(v1) {
    this.vx = this.vx + v1.vx;
    this.vy = this.vy + v1.vy;
    //this.p2.x = this.p1.x + this.vx;
    //this.p2.y = this.p1.y + this.vy;

}


Vecteur2D.prototype.mul = function(scal) {
    this.vx = this.vx * scal;
    this.vy = this.vy * scal;
    //this.p2.x = this.p1.x + this.vx;
    //this.p2.y = this.p1.y + this.vy;
}


Vecteur2D.prototype.norme = function() {
    return Math.round(Math.sqrt(Math.pow(this.vx, 2) + Math.pow(this.vy, 2)));
}

Vecteur2D.prototype.prodScalaire = function(v2) {
    return this.vx * v2.vx + this.vy + v2.vy;
}

Vecteur2D.prototype.symetrieX = function() {
    this.vx=-this.vx;
}

Vecteur2D.prototype.symetrieY = function() {
    this.vy=-this.vy;
}

Vecteur2D.prototype.symetrieOrigine = function() {
    this.symetrieX();
    this.symetrieY();
}

Vecteur2D.prototype.toString = function() {
    return "Vecteur2D [vx="+this.vx+", vy="+this.vy+"]";
}

Vecteur2D.prototype.toJsonString = function() {

    return '{"vx":'+this.vx+', "vy":'+this.vy+'}';
}


let p1 = new Point(2, 1);
let p2 = new Point(4, 5);
let v1 = new Vecteur2D(p1, p2);

console.log(v1);
console.log(v1.p1);
console.log(v1.p2);
console.log(v1.norme());


v1.mul(3);


console.log(v1);
console.log(v1.norme());

console.log(v1.toString());
console.log(v1.toJsonString());

//xx'+yy'
*/

