<?php
require_once("./BD/.BDAchatVente.php");

if(isset($_GET['action']))
{
    if($_GET['action']=="deco"){
    	$_SESSION=array();
    	header('Location: ./login.php');
    }
}
