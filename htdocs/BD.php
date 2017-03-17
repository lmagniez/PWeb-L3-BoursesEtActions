
<?php

#./xw32df4/
$dsn = "sqlite:BDD.sqlite3" ;
$pdo = new PDO($dsn);
if(!$pdo) echo 'Erreur connection bdd';

$queryCreateUser = '
CREATE TABLE IF NOT EXISTS Utilisateur
(
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    user VARCHAR(100),
    Argent DECIMAL,
);';

$queryCreateAction = '
CREATE TABLE IF NOT EXISTS Action
(
    idAction INTEGER PRIMARY KEY AUTOINCREMENT,
    nomAction VARCHAR(100),
    valeur DECIMAL,
);';

$queryCreateActionUser = '
CREATE TABLE IF NOT EXISTS Action_Utilisateur
(
    idUser FOREIGN KEY REFERENCES Utilisateur(idUser),
    idAction FOREIGN KEY REFERENCES Action(idAction)
);';


$querySelect = 'SELECT * from message;';

$prep = $pdo->prepare($queryCreateUser);
$prep->execute();
$prep = $pdo->prepare($queryCreateAction);
$prep->execute();
$prep = $pdo->prepare($queryCreateActionUser);
$prep->execute();


function insert($message,$user,$color){
 //$prep = $pdo->prepare($queryInsert);
 //$prep->bindValue(':msg', $message, PDO::PARAM_STR);
 //$prep->bindValue(':user', $user, PDO::PARAM_STR);
 //$prep->bindValue(':color', $color, PDO::PARAM_STR);
 //$prep->execute();
}

function recuperer(){

// $prep = $pdo->prepare($querySelect);
// $prep->execute();

 //echo $prep;
}
?>
