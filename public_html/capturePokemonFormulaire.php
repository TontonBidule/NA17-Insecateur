
<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');
//AUCUN SELECTIONNE
$vSql1 = "SELECT * FROM ParametresAdmin";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$param=$vResult1['distancemaxpokemon'];
$vSql2 = "SELECT * FROM PokemonPotentiels('".$pseudo."',$param);";
$vQuery2 = pg_query($vSql2);		


$vSql3 = "SELECT * FROM Posseder,Pokeball WHERE Posseder.objet=Pokeball.nom AND Posseder.joueur='$pseudo' AND Posseder.quantite>0;";
$vQuery3 = pg_query($vSql3);		


	if(empty($row=pg_fetch_array($vQuery2)))
	{
	echo "Pas de pokemons a l'horizon...";	
	}
	
else if (empty($row3=pg_fetch_array($vQuery3)))
	{
	echo "Pas de pokeballs dans votre inventaire...";	
	}
else
	{
	echo "<body onload='pokemons.reset();'>";
	echo '<form action="capturePokemonResultat.php?pseudo='.$pseudo.'" id=pokemons method=POST>';
	do
		{
		$chaine= $row["nom"].':'.$row["num"];
		echo "<input type='radio' name='pokemon' value='$chaine'>".$row["nom"];
		echo "<br>";// on affiche l'option.
		}
	while($row = pg_fetch_array($vQuery2));
	
	echo "<select name='objetchoisi'>";
		do
		{
		$nomobjet= $row3['objet'];
		$quantite= $row3['quantite'];
		
		echo "<OPTION value = '".$nomobjet."' > $nomobjet : ($quantite)";
		echo "<br>";// on affiche l'option.
		}
	while($row3 = pg_fetch_array($vQuery3));
	echo "</select>";
	echo "<br>";
	echo '<input type="submit" value="Tenter la capture">';
	echo '</form>';
	echo '</body>';
	
	echo '</html>';
	
	}

?>
  