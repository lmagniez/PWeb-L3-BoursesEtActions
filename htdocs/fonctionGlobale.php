<?php
session_start();
//mapage.php
if(isset($_GET['action']))
{
    if($_GET['action']=="deco"){
    	$_SESSION=array();
    	header('Location: ./login.php');
    }
}
