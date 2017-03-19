<?php

$dsn = "sqlite:BDD.sqlite3" ;
$pdo = new PDO($dsn);
if(!$pdo) echo 'Erreur connection bdd';

$queryCreateUser = '
CREATE TABLE IF NOT EXISTS Utilisateur
(
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    password VARCHAR(100),
    adressemail VARCHAR(150),
    Argent DECIMAL
);';

$queryCreateAction = '
CREATE TABLE IF NOT EXISTS Action
(
    idAction INTEGER PRIMARY KEY AUTOINCREMENT,
    nomAction VARCHAR(100),
    valeur DECIMAL
);';

$queryCreateActionUser = '
CREATE TABLE IF NOT EXISTS Action_Utilisateur
(
    idUser INTEGER ,
    idAction INTEGER ,
    nombreAction int,
    FOREIGN KEY ( idUser ) REFERENCES Utilisateur(idUser),
     FOREIGN KEY (idAction) REFERENCES Action(idAction)
);';


$querySelectUtilisateur = 'SELECT * from Utilisateur;';
$querySelectAction = 'SELECT * from Action;';
$querySelectActionUser = 'SELECT * from Action_Utilisateur;';

$prep = $pdo->prepare($queryCreateUser);
$prep->execute();
$prep = $pdo->prepare($queryCreateAction);
$prep->execute();
$prep = $pdo->prepare($queryCreateActionUser);
$prep->execute();