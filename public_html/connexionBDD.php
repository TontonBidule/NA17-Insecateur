
<?php
session_start();
if(!isset($engineLoaded))
{
$engineLoaded = true;}


include("identifiants.php");


// Connexion à la BDD
$vConn = pg_connect("host=$bddHost port=$bddPort dbname=$bddDbname user=$bddUser password=$bddPassword");
if(!$vConn)
{
	echo "Erreur de connexion a la base de donnees $bddDbname\n";
	exit;
}

include("enregistrementGPS.php")
?>