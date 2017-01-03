<?php
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
	//$vSql = "SELECT * FROM ParametresAdmin";
	//$vQuery = pg_query($vConn,$vSql); 
	//$vResult = pg_fetch_array($vQuery);
	//echo $vResult['distancemaxpokestop'];
	//echo "C'est bon jimmy on a les parametres admin !";
}
include("enregistrementGPS.html");
?>
