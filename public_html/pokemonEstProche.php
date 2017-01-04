
<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');

$pseudo="Arobaz";
$vSql1 = "SELECT * FROM ParametresAdmin";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$param=$vResult1['distancemaxpokemon'];
$vSql2 = "SELECT * FROM PokemonPotentiels('".$pseudo."',$param);";
$vQuery2 = pg_query($vSql2);		
$row=pg_fetch_array($vQuery2);

	if(empty($row))
	{
	echo "Pas de pokemons a l'horizon...";	
	}
else
	{
	echo '<form action="capturePokemon.php" method=POST>';
	do
		{
		$chaine= $row["nom"].':'.$row["num"];
		echo "<input type='checkbox' name='pokemon[]' value='$chaine'>".$row["nom"];
		echo "<br>";// on affiche l'option.
		}
	while($row = pg_fetch_array($vQuery2));
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo $chaine;
	echo '</html>';
	
	}

?>
  