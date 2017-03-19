<?php
session_start();

if(!array_key_exists('nom', $_SESSION)){
    header('Location: ./login.php');
    exit();
}

function recupNomPrenom(){
  return $_SESSION["nom"]." ".$_SESSION["prenom"];
}

?><html>
	<head>
		<meta charset="utf-8"/>
		 <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="./bootstrap-3.3.7-dist/js/bootstrap.min.js" rel="stylesheet">
		 <script type="text/javascript" src="./bootstrap-3.3.7-dist/jquery-3.2.0.min.js"></script>
		 <link href="./css/image.css" rel="stylesheet">
		<link href="./css/accueil.css" rel="stylesheet">
    <link href="./css/profil.css" rel="stylesheet">
	</head>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
       <a class="navbar-brand" href=""><?php echo recupNomPrenom(); ?></h4></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="./accueil.php">Home</a></li>
        <li><a href="./bourse.php">Bourse</a></li>
        <li><a href="./profil.php">Profil</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="fonctionGlobale.php?action=deco"><span class="glyphicon glyphicon-log-out"></span> Deconnecte</a></li>
      </ul>
    </div>
  </div>
</nav>