<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');
//TOUJOURS VERIFIER QUE LE PARAMETRES ADMIN EST REMPLI

$vSql1 = "SELECT * FROM ParametresAdmin";
$vQuery1 = pg_query($vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$param=$vResult1['distancemaxpokestop'];
$vSql2 = "SELECT * FROM PokestopPotentiels('".$pseudo."',$param)";
$vQuery2 = pg_query($vSql2);		
$row=pg_fetch_array($vQuery2);

	if(empty($row))
	{
	echo "Pas de pokestops pour l'instant";
	echo "<br>";
	

	
	
	}
else
	{
		echo "<body onload='pokestops.reset();'>";
	echo '<form action="visitePokestopResultat.php?pseudo='.$pseudo.'" id=pokestops method=POST>';
	do
		{
		$nom=$row["nom"];
		echo "<input type='checkbox' name='pokestop[]' value=".$nom.">".$nom;
		echo "<br>";// on affiche l'option.
		}
	while($row = pg_fetch_array($vQuery2));
	echo '<input type="submit" value="Visiter">';
	echo '</form>';
	echo'</body>';
	echo '</html>';
	}
	
$vSql3 = "SELECT * FROM PokestopAttente('".$pseudo."',$param)";
	$vQuery3 = pg_query($vSql3); 
	$vResult3 = pg_fetch_array($vQuery3);
	
	if(!empty($vResult3))
	{
	do{
	echo "Ouverture du pokestop ";
	echo $vResult3['nom'];
	echo " dans ";
	echo $vResult3['attente'];
	echo "<br>";
		
	}
	while($vResult3 = pg_fetch_array($vQuery3));
	}


#$DateEvenement = new DateTime("tomorrow +7h",new DateTimezone("Europe/Paris"));//demain, sept heures
#$DateNow = new DateTime("now",new DateTimezone("Europe/Paris"));//aujourd'hui
#$TempsRestant = $DateNow->diff($DateEvenement);
#printf("Il reste %s jour %s heures %s minutes %s secondes",
#$TempsRestant->d, $TempsRestant->h,$TempsRestant->i,$TempsRestant->s);
?>