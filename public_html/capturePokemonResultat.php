
<html>

<?php
include('connexionBDD.php');
$pseudo=$_GET['pseudo'];

$vSql1 = "SELECT maxCapture FROM ParametresAdmin";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$maxCapture= $vResult1['maxcapture'];

$vSql1 = "SELECT nbPokemonsCapturesAjd FROM Joueur WHERE nom='$pseudo'";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = $vQuery1;
$nbPokemonsCapturesAjd= $vResult1['nbPokemonsCapturesAjd'];

$restant=$maxCapture-$nbPokemonsCapturesAjd;

if (!isset($_POST['pokemon']))
{header('Location:explorer.php?pseudo='.$pseudo);}

if (($restant)<0)
	{
	echo "Vous n'êtes pas autorisés à attraper autant de pokemons, vous pouvez encore en attraper $restant aujourd'hui";
	}
else
{
	foreach($_POST['pokemon'] as $valeur)
	{
		//echo "voici";
		//echo $valeur;
		$pieces = explode(":",$valeur,2);
		$nom=$pieces[0]; 
		//echo $nom;
		$num=$pieces[1];
		//echo $num;
		//echo "La checkbox $nom a été cochée<br>";
		
		$vSql1 = "SELECT probaCapture FROM EspecePokemon WHERE nom='$nom'";
		$vQuery1 = pg_query($vConn,$vSql1); 
		$vResult1 = pg_fetch_array($vQuery1);
		$probaCapture=$vResult1['probacapture'];
		
		//echo $probaCapture;
		$rand=(((float)rand())/((float)getrandmax()));
		//echo $rand;
		if ($rand<$probaCapture)
			{
			echo "- CAPTURE REUSSIE, TU REMPORTES $nom -";
			echo "<br>";
			$vSql2 = "BEGIN TRANSACTION;
						INSERT INTO PokemonCapture VALUES('$nom',$num,'$pseudo','pokeball'); 
						  DELETE FROM PokemonSauvage WHERE nom='$nom' AND num=$num;
						    UPDATE Joueur SET nbPokemonsCapturesAjd=nbPokemonsCapturesAjd+1 WHERE nom='$pseudo';
							  COMMIT;";
			$vQuery1 = pg_query($vConn,$vSql2); 
			
			
			}
		else
			{
			echo "- LA CAPTURE DE $nom A ECHOUE ! -";
			}
	}
	
}
echo "<br>";
echo '<a href="http://tuxa.sme.utc/~nf17a016/explorer.php?pseudo='.$pseudo.'">Continuer a explorer !</a>';
?>
 
</html>