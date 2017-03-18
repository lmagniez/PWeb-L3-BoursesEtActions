
<?php

#./xw32df4/
$dsn = "sqlite:BDD.sqlite3" ;
$pdo = new PDO($dsn);
//echo exec("whoami");
if(!$pdo) echo 'Erreur connection bdd';

$queryCreate = '
CREATE TABLE IF NOT EXISTS message
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user VARCHAR(100),
    msg VARCHAR(100),
    color VARCHAR(100)
);';

$queryInsert = 'INSERT INTO message (user, msg, color) VALUES (:user, :msg, :color);';
#$queryInsert = 'INSERT INTO message (user, msg) VALUES ("user", "message");';

$querySelect = 'SELECT * from message;';


$prep = $pdo->prepare($queryCreate);
$prep->execute();


function insert($message,$user,$color){
 global $pdo;
 global $queryInsert;

 $prep = $pdo->prepare($queryInsert);
 $prep->bindValue(':msg', $message, PDO::PARAM_STR);
 $prep->bindValue(':user', $user, PDO::PARAM_STR);
 $prep->bindValue(':color', $color, PDO::PARAM_STR);
 $prep->execute();
 print_r($prep->errorInfo());

}

function recuperer(){
 global $pdo;
 global $querySelect;
 $prep = $pdo->prepare($querySelect);
 $prep->execute();
 print_r($prep->fetchAll());

 //echo $prep;
}


#insert("message","moi");
if(isset($_POST['message'])&&isset($_POST['pseudo'])&&isset($_POST['color-pseudo'])){
	insert($_POST['message'],$_POST['pseudo'],$_POST['color-pseudo']);
}
//recuperer();
recuperer();
header('Location: message.php');

?>
