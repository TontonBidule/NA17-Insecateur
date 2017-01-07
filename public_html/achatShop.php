


<form action = "achatShopVerif1.php" method = "POST">
	Choisissez un objet à acheter : <SELECT name="nomObjet" size="1">
		<?php
			include('connexionBDD.php');
			$pseudo = "Arobaz";
			$vSql = "SELECT o.nom, prixargentreel(o.nom)  
					FROM Objet o, Vendre v, joueur j, shop s 
					WHERE o.type='achetable' AND v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;";
			$vQuery = pg_query($vConn, $vSql);
			while($vResult = pg_fetch_array($vQuery)){ 
		?>	
				<OPTION value = <?php echo "$vResult[nom] > $vResult[nom] : $vResult[prixargentreel] pc"?>
				
		<?php
		};
		?>
	</SELECT>

	entrez la quantité : <input type ="number", name = "nombre" />
	<input type ="submit" value="valider" />
</form>
