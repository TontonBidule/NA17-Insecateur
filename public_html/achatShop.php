

<?php

include('connexionBDD.php');
include('index.php');

$pseudo = $_GET['pseudo'];

$vSql = "SELECT pokeCoins
					FROM Joueur
					WHERE nom='$pseudo'";
			$vQuery = pg_query($vConn, $vSql);
			$vResult = pg_fetch_array($vQuery);
			$somme = $vResult['pokecoins'];

			echo "Bienvenue $pseudo, vous disposez de $somme pokecoins !";
			echo "<br>";
			echo "<br>";

			
			$vSql = "SELECT o.nom, prixargentreel(o.nom)
					FROM Objet o, Vendre v, joueur j, shop s 
					WHERE o.type='achetable' AND v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays AND j.nom='$pseudo';";
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
			$nomobjet=$vResult['nom'];
		
			echo "<OPTION value = '".$nomobjet."' > $nomobjet : ".$vResult['prixargentreel']." pc";}
				
			while($vResult = pg_fetch_array($vQuery));
			
	echo "</SELECT>";

	echo " entrez la quantite : <input type ='number', name = 'nombre'/>";
	echo '<input type ="submit" value="valider" />';
	echo '<input type="hidden" name="somme" value='.$somme.'>';
			echo "</form>";}
	echo "<br>";
	
	echo '<form action = "rechargement.php?pseudo='.$pseudo.'" method = "POST">';
	echo "Entrez la somme a recharger. : <input type ='number', name = 'rechargement'/>";
	echo '<input type ="submit" value="Valider" />';
?>
