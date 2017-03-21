<?php
require_once("BD.php");
session_start();

$UpdateSomme='UPDATE Utilisateur SET Argent = :newArgent where idUser = :idU';

$queryRecupID = 'SELECT * from Utilisateur where adressemail = :mail ;';
$queryRecupIDAction='SELECT idAction from Action where nomAction= :nameA;';
$queryInsertAction='INSERT INTO Action (nomAction) VALUES (:nameA);';

$VerifSiPossedAction='SELECT nombreAction from Action_Utilisateur where idUser = :idU and idAction = :idA ;';
$UpdateNbAction='UPDATE Action_Utilisateur SET nombreAction = :newAction where  idUser = :idU and idAction = :idA ;';
$InsetActionUser='INSERT INTO Action_Utilisateur (idUser,idAction,nombreAction) VALUES (:idU,:idA,:nb)';

function achat($tab,$mail,$argent){
    if($_SESSION["argent"]-$tab[2] < 0 ){
        $_SESSION["transaction"]="Probleme Achat";
        header('Location: ./../bourse.php');
        return;
    }

    global $pdo;
    global $queryRecupIDAction;
    global $queryInsertAction;
    global $VerifSiPossedAction;
    global $UpdateNbAction;
    global $InsetActionUser;
    global $queryRecupID;
    global $UpdateSomme;

    //on verifie si l'action est en base
    $prep = $pdo->prepare($queryRecupIDAction);
    $prep->bindValue(':nameA', $tab[1], PDO::PARAM_STR);
    $prep->execute();
    $resAction=$prep->fetchAll();

    //si elle ne l'ai pas on l'insere
    if(sizeof($resAction)==0){
        $prep = $pdo->prepare($queryInsertAction);
        $prep->bindValue(':nameA', $tab[1], PDO::PARAM_STR);
        $prep->execute();

        //on recup l'id de l'action
        $prep = $pdo->prepare($queryRecupIDAction);
        $prep->bindValue(':nameA', $tab[1], PDO::PARAM_STR);
        $prep->execute();
        $resAction=$prep->fetchAll();
    }

    $idAction=$resAction[0]["idAction"];

    //on recup l'id du User
    $prep = $pdo->prepare($queryRecupID);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->execute();
    $res=$prep->fetchAll();
    $idUser=$res[0]["idUser"];

    //on verifie si on a deja une action avec le meme nom
    $prep = $pdo->prepare($VerifSiPossedAction);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
    $prep->bindValue(':idA', $idAction, PDO::PARAM_INT);
    $prep->execute();
    $resNOM=$prep->fetchAll();

    if(sizeof($resNOM)==0){
        //on creer alors la ligne
        $prep = $pdo->prepare($InsetActionUser);
        $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
        $prep->bindValue(':idA', $idAction, PDO::PARAM_INT);
        $prep->bindValue(':nb', 1 , PDO::PARAM_INT);
        $prep->execute();
        $res=$prep->fetchAll();
    }
    else{
        $nomb=$resNOM[0]["nombreAction"];
        $prep = $pdo->prepare($UpdateNbAction);
        $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
        $prep->bindValue(':idA', $idAction, PDO::PARAM_INT);
        $prep->bindValue(':newAction', $nomb+1, PDO::PARAM_INT);
        $prep->execute();
        $res=$prep->fetchAll();
    }

    //on Update la somme d'argent
    $prep = $pdo->prepare($UpdateSomme);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
    $prep->bindValue(':newArgent', $_SESSION["argent"]-$tab[2] , PDO::PARAM_INT);
    $prep->execute();
    $res=$prep->fetchAll();


    $_SESSION["argent"]=$_SESSION["argent"]-$tab[2];
    $_SESSION["transaction"]="Achat Reussis pour l'action ".$tab[0];
    recupNom($_SESSION["mail"]);
    header('Location: ./../bourse.php');
}

function vente($tab,$nbAction,$mail,$argent){
    global $pdo;
    global $queryRecupIDAction;
    global $queryRecupID;
    global $VerifSiPossedAction;
    global $UpdateNbAction;
    global $UpdateSomme;

    //on recup l'id de l'action
    $prep = $pdo->prepare($queryRecupIDAction);
    $prep->bindValue(':nameA', $tab[1], PDO::PARAM_STR);
    $prep->execute();
    $resAction=$prep->fetchAll();
    $idAction=$resAction[0]["idAction"];

    //on recup l'id de l'user
    $prep = $pdo->prepare($queryRecupID);
    $prep->bindValue(':mail', $mail, PDO::PARAM_STR);
    $prep->execute();
    $res=$prep->fetchAll();
    $idUser=$res[0]["idUser"];

    //on recup le nombre d'action
    $prep = $pdo->prepare($VerifSiPossedAction);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
    $prep->bindValue(':idA', $idAction, PDO::PARAM_INT);
    $prep->execute();
    $resNOM=$prep->fetchAll();
    $nomb=$resNOM[0]["nombreAction"];

    //on set le nom
    $nb=$nbAction; 

    //on update le nombre d'action y pour le User x
    $prep = $pdo->prepare($UpdateNbAction);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
    $prep->bindValue(':idA', $idAction, PDO::PARAM_INT);
    $prep->bindValue(':newAction', $nomb-$nb, PDO::PARAM_INT); 
    $prep->execute();
    $res=$prep->fetchAll();

    //on Update la somme d'argent
    $prep = $pdo->prepare($UpdateSomme);
    $prep->bindValue(':idU', $idUser, PDO::PARAM_INT);
    $prep->bindValue(':newArgent', $_SESSION["argent"]+($nb*$tab[2]), PDO::PARAM_INT);
    $prep->execute();
    $res=$prep->fetchAll();

    $_SESSION["argent"]=$_SESSION["argent"]+($nb*$tab[2]);
    $_SESSION["transaction"]="Vente Reussis pour l'action ".$tab[0]." au nombre de ".$nbAction;
    recupNom($_SESSION["mail"]);
    header('Location: ./../profil.php');
}

if(array_key_exists('achat', $_POST)){
    achat(explode(";",$_POST["achat"]),$_SESSION["mail"],$_SESSION["argent"]);
}

if(array_key_exists('vente', $_POST)){
    if(array_key_exists('nb-vente', $_POST))
        vente(explode(";",$_POST["vente"]),$_POST["nb-vente"],$_SESSION["mail"],$_SESSION["argent"]);
    else{
        $_SESSION["transaction"]="";
        header('Location: ./../profil.php');
    }
}



