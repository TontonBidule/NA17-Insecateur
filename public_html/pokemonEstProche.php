<?php
#(sqrt((coord_lattitude-$latJ)**2+(coord_longitude-$lonJ)**2)<$adminD)
session_start();
if(!isset($_SESSION['engineLoaded']))
{
	echo "olala";
	include('connexionBDD.php');
}
else
{
					echo $_SESSION['distanceMaxPokestop'];
					echo $_SESSION['distanceMaxPokemon'];
					echo $_SESSION['maxCapture'];
					echo $_SESSION['maxPokestopsVisitables'];
					echo $_SESSION['engineLoaded'];
					$latJ = $_SESSION['latJ'];
					$lonJ = $_SESSION['lonJ'];
					$adminD = $_SESSION['distanceMaxPokemon'];
					$vSql = "SELECT * FROM PokemonSauvage";
					$vQuery = pg_query($vSql); 
							echo "pokemon dispo";
							while( $vResult = pg_fetch_array($vQuery))
							{
								echo "<option value="+'"$vResult['+"'nom'"+']"'+"</option>"; // on affiche l'option.
							}
							
}
						?>
						
						