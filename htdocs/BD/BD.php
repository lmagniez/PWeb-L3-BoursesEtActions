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
    nomAction VARCHAR(100)
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

$queryRecupID = 'SELECT * from Utilisateur where adressemail = :mail ;';
$RecupToutesAction='SELECT nomAction , nombreAction from Action INNER JOIN Action_Utilisateur ON Action.idAction=Action_Utilisateur.idAction 
                                                 INNER JOIN Utilisateur ON  Utilisateur.idUser=Action_Utilisateur.idUser 
                                                 where Utilisateur.idUser = :idU';

function recupNom($mail){
    global $pdo;
    global $RecupToutesAction;
    global $queryRecupID;
    
    //on recup l'id du User
    $prep = $pdo->prepare($queryRecupID);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->execute();
    $res=$prep->fetchAll();
    $idUser=$res[0]["idUser"];


    $prep = $pdo->prepare($RecupToutesAction);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_STR);
    $prep->execute();
    $res=$prep->fetchAll();
    $_SESSION["actions"]=$res;
}