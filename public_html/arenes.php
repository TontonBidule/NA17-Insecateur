<?php
	include('connexionBDD.php');


	$vSqlParamAdmin = "SELECT * FROM ParametresAdmin";
	$vQuery = pg_query($vConn, $vSqlParamAdmin);
	$vResultAdmin = pg_fetch_array($vQuery);
	$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('$pseudo', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	
	if (empty($row = pg_fetch_array($vQuery)))
	{
		echo "Pas d'arenes a proximite...";
	}
	else
	{
	do{
	$nom=$row['nom'];
	echo '<form action="combat.php?pseudo='.$pseudo.'" id=pokemons method=POST>';
	echo "<input type='radio' name='arene' value='$nom'>$nom";
		}
	while($row = pg_fetch_array($vQuery));
	echo"<br>";
	echo '<input type="submit" value="Combattre">';
	echo '</form>';
	
	
	
	
		
	};
?>

