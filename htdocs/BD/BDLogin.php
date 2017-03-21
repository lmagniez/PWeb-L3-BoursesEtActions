<?php
require_once("BD.php");
session_start();
$queryRecupUser = 'SELECT * from Utilisateur where adressemail = :mail ;';

if(isset($_POST)){
	global $pdo;
	$prep = $pdo->prepare($queryRecupUser);
	$prep->bindValue(':mail', $_POST["Mail"], PDO::PARAM_STR);
	$prep->execute();
	$res=$prep->fetchAll();

	if(sizeof($res)==0){
		$_SESSION['messageConnection']="Adresse Non repertoriée".PHP_EOL;
		header('Location: ./../login.php');
		return;
	}

	if($res[0]["password"] != $_POST["mdp"]){
		$_SESSION['messageConnection']="Mot de passe incorrect".PHP_EOL;
		header('Location: ./../login.php');
		return;
	}

	$_SESSION['messageConnection']="good";
	$_SESSION['nom']=$res[0]["nom"];
	$_SESSION['prenom']=$res[0]["prenom"];
	$_SESSION['argent']=$res[0]["Argent"];
	$_SESSION['mail']=$res[0]["adressemail"];
	$_SESSION['mdp']=$res[0]["password"];
	recupNom($_SESSION['mail']);
	header('Location: ./../login.php');
}