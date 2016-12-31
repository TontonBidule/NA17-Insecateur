<?php
session_start();
if(!isset($_SESSION['engineLoaded']))
{
	$_SESSION['engineLoaded']=true;
	}


include("identifiants.php");


// Connexion à la BDD
$vConn = pg_connect("host=$bddHost port=$bddPort dbname=$bddDbname user=$bddUser password=$bddPassword");
if(!$vConn)
{
	echo "Erreur de connexion a la base de donnees $bddDbname\n";
	exit;
}
else
{
	$vSql = "SELECT * FROM ParametresAdmin";
	$vQuery = pg_query($vConn,$vSql); 
	$vResult = pg_fetch_array($vQuery)
	echo $vQuery[1];
	$_SESSION['distanceMaxPokestop']=$vResult[0];
	$_SESSION['distanceMaxPokemon']=$vResult[1];
	$_SESSION['maxCapture']=$vResult[2];
	$_SESSION['maxPokestopsVisitables']=$vResult[3];
	echo $_SESSION['maxCapture'];
	echo "C'est bon jimmy on a les parametres admin !";
}
include("enregistrementGPS.html");
?>
