<?php
	include('connexionBDD.php');

	$pseudo = "Arobaz";
	$vSql = "SELECT o.nom, prixargentreel(o.nom)  
			FROM Objet o, Vendre v, joueur j, shop s 
			WHERE o.type='achetable' AND v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom], prix : $vResult[prixargentreel]\n";
	};
?>



<form action = "achatShopVerif1.php" method = "POST">
	entrez le nom de l'objet à acheter : <input type = "text", name="nomObjet" />
	<input type ="submit" value="valider" />
</form>
