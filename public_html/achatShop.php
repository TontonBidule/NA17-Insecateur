

<?php

include('connexionBDD.php');
			$pseudo = "Arobaz";
			$vSql = "SELECT o.nom, prixargentreel(o.nom)  
					FROM Objet o, Vendre v, joueur j, shop s 
					WHERE o.type='achetable' AND v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;";
			$vQuery = pg_query($vConn, $vSql);
			$vResult = pg_fetch_array($vQuery);


	
			
			if (empty($vResult))
			{
				echo "Pas d'objets a vendre dans ce shop";
				echo "<br>";
			}
			else
			{
			echo '<form action = "achatShopVerif1.php?pseudo='.$pseudo.'" method = "POST">';
			echo 'Choisissez un objet a acheter : <SELECT name="nomObjet" size="1">';
			do{ 
		
			echo "<OPTION value = ".$vResult['nom']." > $vResult[nom] : ".$vResult['prixargentreel']." pc";}
				
			while($vResult = pg_fetch_array($vQuery));
			
	echo "</SELECT>";

	echo " entrez la quantite : <input type ='number', name = 'nombre'/>";
	echo '<input type ="submit" value="valider" />';
			echo "</form>";}
?>
