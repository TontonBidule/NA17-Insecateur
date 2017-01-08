<?php
	include('connexionBDD.php');
	
	
	$pseudo = "Arobaz";
	$vSqlExistanceObjet = "SELECT prixargentreel(o.nom), s.pays pays, j.argent
			FROM Objet o, Vendre v, joueur j, shop s
			WHERE o.type='achetable' AND o.nom = '$_POST[nomObjet]' AND  v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;"; 
	$vQuery = pg_query($vConn, $vSqlExistanceObjet);
	
	if(! ($vResult = pg_fetch_array($vQuery))){
		echo "erreur, veuillez saisir un objet existant : $_POST[nomObjet] n existe pas";
		include('achatshop.php');
		exit();	
	}
	$prixpotion =  $vResult["prixargentreel"] * $_POST['nombre'];
	
	
	if($vResult['argent'] < $prixpotion){
		echo 'erreur, tu es peut etre un tres bon dresseur, mais tu n as pas assez d argent';
		include('achatshop.php');
		exit();		
	}
	echo 'la transaction a bien ete effectuee o grand dresseur';
	
	
	
	
	$vSqlModifDonnees = "
		INSERT INTO posseder VALUES ('$pseudo', '$_POST[nomObjet]', 0);
		BEGIN TRANSACTION;";
	pg_query($vConn, $vSqlModifDonnees);
	$vSqlModifDonnees = "UPDATE posseder SET quantite = quantite + 1 WHERE joueur='$pseudo' AND objet = '$_POST[nomObjet]'; 
		INSERT INTO effectuertransactionavec VALUES ('$vResult[pays]', '$pseudo', NOW(), $prixpotion);
		UPDATE joueur SET argent = argent - $prixpotion WHERE nom='$pseudo';
		COMMIT;";
	pg_query($vConn, $vSqlModifDonnees);
	
	include('achatshop.php');
/*INSERT INTO posseder VALUES ('$pseudo', '$_POST[nomObjet]', 0);	
INSERT INTO posseder VALUES ('Arobaz', 'Potion de soin mineure', 0);*/





	/*$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('Arobaz', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom]\n";
		echo"\n";
	};*/
?>

