<?php
	include('connexionBDD.php');
	
	
	$pseudo = "Arobaz";
	$vSqlExistanceObjet = "SELECT o.nom, prixargentreel(o.nom), s.pays 
			FROM Objet o, Vendre v, joueur j, shop s 
			WHERE o.type='achetable' AND v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;"; 
	$vQuery = pg_query($vConn, $vSqlExistanceObjet);
	
	if(! ($vResult = pg_fetch_array($vQuery))){
		echo "erreur, veuillez saisir un objet existant : $_POST[nomObjet] n existe pas";
		include('achatshop.php');
		exit();	
	}
	
	echo $vResult["prixargentreel"] ;
	$prixpotion =  $vResult["prixargentreel"] ;
	$vSqlArgentJoueur = "SELECT nom, argent FROM Joueur  WHERE nom ='$pseudo';";
	
	$vQuery2 = pg_query($vConn, $vSqlArgentJoueur);
	$vResult2 = pg_fetch_array($vQuery2);
	
	echo "argent joueur : $vResult2[argent]";
	echo "prix potion $prixpotion";
	if($vResult2['argent'] < $prixpotion){
		echo 'erreur, sale pauvre';
		include('achatshop.php');
		exit();		
	}
	echo 'gg le riche';
	echo "pays : $vResult[pays]";
	echo "pseudo : $pseudo";
	echo "date : NOW()";
	echo "prix potion $prixpotion";	
	$vSqlModifDonnees = "INSERT INTO effectuertransactionavec VALUES ('$vResult[pays]', '$pseudo', NOW(), $prixpotion);";
	pg_query($vConn, $vSqlModifDonnees);
	$vSqlModifDonnees = "UPDATE joueur SET argent = argent - $prixpotion WHERE nom='$pseudo'";
	pg_query($vConn, $vSqlModifDonnees);
	






	/*$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('Arobaz', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom]\n";
		echo"\n";
	};*/
?>

