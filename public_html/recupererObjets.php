
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
$vResult1 = pg_fetch_array($vQuery1);
$nbPokestopsVisitesAjd= $vResult1['nbpokestopsvisitesajd'];

$restant=$maxPokestopsVisitables-$nbPokestopsVisitesAjd;

if (!isset($_POST['pokestop']))
{header('Location:pokestopEstProche.php');}

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
		
		$vSql2 = "UPDATE Joueur SET nbPokestopsVisitesAjd=nbPokestopsVisitesAjd+1 WHERE nom='$pseudo'";
		//$vSql5= "INSERT INTO Visiter(joueur,pokestop,derniereVisite) VALUES ('$pseudo','$nom',NULL) ON CONFLICT DO UPDATE derniereVisite='NULL' WHERE nom='$pseudo' AND pokestop=$nom";
		//$vSql6="MERGE INTO Visiter USING Visiter ON Visiter.joueur='$pseudo' AND pokestop='$nom' WHEN MATCHED THEN UPDATE SET     Visiter.derniereVisite=NULL WHEN NOT MATCHED THEN INSERT (joueur,pokestop,derniereVisite) VALUES ('$pseudo','$nom',NULL)";
		$vQuery2 = pg_query($vConn,$vSql2);
		
		
		$vSql7="UPDATE Visiter SET derniereVisite=CURRENT_TIMESTAMP WHERE joueur='$pseudo' AND pokestop='$nom';
		INSERT INTO Visiter (joueur,pokestop,derniereVisite)
       SELECT '$pseudo','$nom',CURRENT_TIMESTAMP
       WHERE NOT EXISTS (SELECT 1 FROM Visiter WHERE Visiter.joueur='$pseudo' AND pokestop='$nom');";
	   $vQuery7 = pg_query($vConn,$vSql7);	
		
		echo "La checkbox $nom a ete cochee<br>";
		$vSql1 = "SELECT objet,quantite FROM Proposer WHERE pokestop='$nom'";
		$vQuery1 = pg_query($vConn,$vSql1); 
		$vResult1 = $vQuery1;
		$row=pg_fetch_array($vResult1);
		
		//DATE A AJOUTER
		
		
		echo "Tu recuperes les objets de ce pokestop <br>";
		if(empty($row))
			{
			echo "Pas d'objets dans celui-la";	
			}
		else
			{
			do
				{
				
				$objet=$row['objet'];
				$quantite=$row['quantite'];
				echo $objet;
				echo $quantite;
					
				//$vSql4 = "INSERT INTO Posseder(joueur,objet,quantite) VALUES('$pseudo','$objet','$quantite') ON DUPLICATE KEY UPDATE quantite=quantite+$quantite WHERE joueur=$joueur AND objet=$objet";
				$vSql7="UPDATE Posseder SET quantite=quantite+$quantite WHERE joueur='$pseudo' AND objet='$objet'";
				$vSql8="INSERT INTO Posseder VALUES('$pseudo','$objet',$quantite)";
				$vSql9="SELECT * FROM Posseder WHERE joueur='$pseudo' AND objet='$objet'";
	   
				$vQuery7 = pg_query($vConn,$vSql7);
				$vResult7 = $vQuery7;
				
				$vQuery9 = pg_query($vConn,$vSql9);
				$vResult9 = $vQuery9;
				
				echo $vResult9;

				if(empty($vResult9))
					{
					echo "youhou";
					$vQuery8 = pg_query($vConn,$vSql8);
					$vResult8 = $vQuery8;
					}
					
				
				}
			while($row = pg_fetch_array($vResult1));
			
				
				
			}
		}
	}
echo "</html>";
?>
</html>