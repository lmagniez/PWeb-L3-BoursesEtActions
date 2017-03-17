
"use strict";

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


