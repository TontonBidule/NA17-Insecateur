<html>

<form action="recolte.php" method=POST>
  <select name="items">

<?php
#(sqrt((coord_latitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
include('connexionBDD.php');
					$pseudo='Arobaz';
					$vSql1 = "SELECT distancemaxpokemon FROM ParametresAdmin";
					$vQuery1 = pg_query($vSql1); 
					$vResult1 = pg_fetch_array($vQuery1);
					
					$vSql2 = "SELECT PokemonPotentiels($pseudo,$vResult)";
					$vQuery2 = pg_query($vSql2); 
							while( $vResult2 = pg_fetch_array($vQuery2))
							{
								echo "<option value="+$vResult2['nom']+'">'+$vResult2['nom']+"</option>"; // on affiche l'option.
							}
							
}
						?>
  </select>
  <input type="submit" value="Submit">
</form>
</html>