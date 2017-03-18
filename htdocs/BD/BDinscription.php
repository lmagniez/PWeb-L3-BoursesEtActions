<?php
require_once("BD.php");
session_start();

$queryVerifieMail = 'SELECT * from Utilisateur where adressemail = :mail ;';
$InsertInscription = 'INSERT INTO Utilisateur (nom , prenom, password ,  adressemail, Argent) VALUES (:mynom, :myprenom , :mypassword , :mymail , :myargent);';

if(isset($_POST)){
	if($_POST["mdp"]!=$_POST["mdpconfirm"]){
		$_SESSION['messageInscription']= "Mot de passe non identique".PHP_EOL;
		header('Location: http://localhost:8888/register.php');
		return;
	}

	//verifie si un compte n'a pas cet email
	global $pdo;
	$prep = $pdo->prepare($queryVerifieMail);
	$prep->bindValue(':mail', $_POST["Mail"], PDO::PARAM_STR);
	$prep->execute();
	
	if(sizeof($prep->fetchAll())!=0){
		$_SESSION['messageInscription']= "Adresse Mail déja presente".PHP_EOL;
		header('Location: http://localhost:8888/register.php');
		return;
	}
	
	$prep = $pdo->prepare($InsertInscription);
 	$prep->bindValue(':mynom', $_POST["Nom"], PDO::PARAM_STR);
 	$prep->bindValue(':myprenom', $_POST["mdpconfirm"] , PDO::PARAM_STR);
 	$prep->bindValue(':mypassword', $_POST["mdp"] , PDO::PARAM_STR);
 	$prep->bindValue(':mymail',$_POST["Mail"] , PDO::PARAM_STR);
 	$prep->bindValue(':myargent',1200 , PDO::PARAM_INT);
 	$prep->execute();

 	$_SESSION['messageInscription']="Inscription Reussie".PHP_EOL;
 	header('Location: http://localhost:8888/login.php');
}