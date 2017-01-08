

<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');
//AUCUN SELECTIONNE
$pseudo="Arobaz";
$vSql1 = "SELECT * FROM ParametresAdmin";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$param=$vResult1['distancemaxpokestop'];

$vSql2 = "SELECT * FROM ShopPotentiel('".$pseudo."');";
$vQuery2 = pg_query($vSql2);		
$row=pg_fetch_array($vQuery2);

	if(empty($row))
	{
	echo "Probleme d'incompatibilite";	
	}
else
	{
	$pays=$row['pays'];
	echo "Bienvenue sur le shop $pays";
	
	}

?>
  