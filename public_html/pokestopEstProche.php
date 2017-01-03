<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');

$pseudo="Arobaz";
$vSql1 = "SELECT * FROM ParametresAdmin";
$vQuery1 = pg_query($vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$param=$vResult1['distancemaxpokestop'];
$vSql2 = "SELECT * FROM PokestopPotentiels('".$pseudo."',$param);";
$vQuery2 = pg_query($vSql2);		
$row=pg_fetch_array($vQuery2);

	if(empty($row))
	{
	echo "Pas de pokestops a l'horizon...";	
	}
else
	{
	echo '<form action="recolte.php" method=POST>';
	do
		{
		echo "<input type='checkbox' name=".$row["nom"]." value=".$row["nom"].">".$row["nom"];
		echo "<br>";// on affiche l'option.
		}
	while($row = pg_fetch_array($vQuery2));
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo '</html>';
	}
?>