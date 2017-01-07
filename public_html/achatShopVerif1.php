<?php
	include('connexionBDD.php');
	
	
	$pseudo = "Arobaz";
	$vSqlExistanceObjet = "SELECT nom, prixargentreel(nom) FROM Objet WHERE nom= '$_POST[nomObjet]' AND type ='achetable';"; 
	$vQuery = pg_query($vConn, $vSqlExistanceObjet);
	
	if(! ($vResult = pg_fetch_array($vQuery))){
		echo "erreur, veuillez saisir un objet existant : $_POST[nomObjet] n existe pas";
		include('achatshop.php');
		exit();	
	}
	
	echo $vResult["prixargentreel"] ;
	$prixpotion =  $vResult["prixargentreel"] ;
	$vSqlArgentJoueur = "SELECT argent AS argentJoueur FROM Joueur  WHERE nom ='$pseudo';";
	
	$vQuery2 = pg_query($vConn, $vSqlArgentJoueur);
	echo "argent joueur : $vQuery2[argentJoueur]";
	echo "prix potion $prixpotion";
	if($vQuery2['argentJoueur'] < $prixpotion){
		echo 'erreur, sale pauvre';
		include('achatshop.php');
		exit();		
	}
	echo 'gg le riche';






	/*$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('Arobaz', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom]\n";
		echo"\n";
	};*/
?>

