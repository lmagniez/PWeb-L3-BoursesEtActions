<?php
require_once("BD.php");
session_start();
$queryRecupUser = 'SELECT * from Utilisateur where adressemail = :mail ;';
$queryUpdateUser = 'UPDATE Utilisateur Set nom = :name , prenom = :surname , password = :mdp , adressemail=:mail where adressemail = :mailorigin';

if(isset($_POST)){
	global $pdo;
	$prep = $pdo->prepare($queryRecupUser);
	$prep->bindValue(':mail', $_POST["Mail"], PDO::PARAM_STR);
	$prep->execute();
	$res=$prep->fetchAll();


	if($_POST["mdp"]!=$_POST["mdpconfirm"]){
		$_SESSION['messageUpdate']= "Modification non prise en compte (Mot de passe non identique)".PHP_EOL;
		header('Location: ./../profil.php');
		return;
	}

	if(sizeof($res)!=0 && $res[0]["adressemail"] != $_SESSION['mail']){
		$_SESSION['messageUpdate']= "Modification non prise en compte (Adresse Mail déja presente)".PHP_EOL;
		header('Location: ./../profil.php');
		return;
	}

	$prep = $pdo->prepare($queryUpdateUser);
 	$prep->bindValue(':name', $_POST["Nom"], PDO::PARAM_STR);
 	$prep->bindValue(':surname', $_POST["Prenom"] , PDO::PARAM_STR);
 	$prep->bindValue(':mdp', $_POST["mdp"] , PDO::PARAM_STR);
 	$prep->bindValue(':mail',$_POST["Mail"] , PDO::PARAM_STR);
 	$prep->bindValue(':mailorigin',$_SESSION['mail'], PDO::PARAM_STR);
 	$prep->execute();

	$_SESSION['messageUpdate']="good";
	$_SESSION['nom']=$_POST["Nom"];
	$_SESSION['prenom']=$_POST["Prenom"];
	$_SESSION['mail']=$_POST["Mail"] ;
	$_SESSION['mdp']=$_POST["mdp"];
	header('Location: ./../profil.php');
}