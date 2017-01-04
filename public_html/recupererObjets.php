
<html>

<?php
include('connexionBDD.php');
$pseudo='Arobaz';

$vSql1 = "SELECT maxPokestopsVisitables FROM ParametresAdmin";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
$maxPokestopsVisitables= $vResult1['maxpokestopsvisitables'];

$vSql1 = "SELECT nbPokestopsVisitesAjd FROM Joueur WHERE nom='$pseudo'";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = $vQuery1;
$nbPokestopsVisitesAjd= $vResult1['nbPokestopsVisitesAjd'];

$restant=$maxPokestopsVisitables-$nbPokestopsVisitesAjd;



if (($restant)<0)
	{
	echo "Vous n'êtes pas autorisés à visiter autant de pokestops, vous pouvez encore en visiter $restant aujourd'hui";
	}
else
	{
	foreach($_POST['pokestop'] as $valeur)
		{
		$nom=$valeur;
		echo $nom;
		
		//GERER LA PREMIERE VISITE
		
		$vSql2 = "BEGIN TRANSACTION;
							UPDATE Joueur SET nbPokestopsVisitesAjd=nbPokestopsVisitesAjd+1 WHERE nom='$pseudo';
							INSERT INTO Visiter VALUES ('$pseudo','$nom',NULL);
							  COMMIT;";
		$vQuery1 = pg_query($vConn,$vSql2);
			
		echo "La checkbox $nom a ete cochee<br>";
		$vSql1 = "SELECT objet,quantite FROM Proposer WHERE pokestop='$nom'";
		$vQuery1 = pg_query($vConn,$vSql1); 
		$vResult1 = $vQuery1;
		$test=pg_fetch_array($vResult1);
		
		//DATE A AJOUTER
		
		
		echo "Tu recuperes les objets de ce pokestop <br>";
		if(empty($test))
			{
			$vSql3 = "INSERT INTO Posseder VALUES('$pseudo','$objet','$quantite')"; 
			$vQuery3 = pg_query($vConn,$vSql3);
			$vResult3 = $vQuery3;	
			}
		else
			{
			do
				{
				
				$objet=$row['objet'];
				$quantite=$row['quantite'];
				echo $objet;
				echo $quantite;
					
				$vSql4 = "UPDATE Posseder SET Posseder.quantite=Posseder.quantite+quantite WHERE Posseder.joueur=$pseudo AND Posseder.objet=$objet"; 
				$vQuery4 = pg_query($vConn,$vSql4);
				$vResult4 = $vQuery4;
				
				
					
				
				}
			while($row = pg_fetch_array($vResult1));
			
				
				
			}
		}
	}
echo "</html>";
?>
</html>