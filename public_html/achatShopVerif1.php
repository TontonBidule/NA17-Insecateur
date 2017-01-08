<?php
	include('connexionBDD.php');
	include('index.php');
	
	$pseudo = $_GET['pseudo'];
	echo "pseudo : $pseudo";
	$vSqlExistanceObjet = "SELECT prixargentreel(o.nom), s.pays pays, j.argent
			FROM Objet o, Vendre v, joueur j, shop s
			WHERE o.type='achetable' AND o.nom = '$_POST[nomObjet]' AND  v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;"; 
	$vQuery = pg_query($vConn, $vSqlExistanceObjet);
	
	$vResult = pg_fetch_array($vQuery);
	$prixpotion =  $vResult["prixargentreel"] * $_POST['nombre'];
	
	
	if($vResult['argent'] < $prixpotion){
		echo 'erreur, tu es peut etre un tres bon dresseur, mais tu n as pas assez d argent';
		exit();	
	}
	echo 'la transaction a bien ete effectuee o grand dresseur';
	

	$vSqltentative="SELECT * FROM Posseder WHERE joueur='$pseudo' AND objet='$_POST[nomObjet]'";
	$vQuery = pg_query($vConn, $vSqltentative);
	if(empty($vResult2 = pg_fetch_array($vQuery))){
		$vSqlModifDonnees = "INSERT INTO posseder VALUES ('$pseudo', '$_POST[nomObjet]', 0);";
		pg_query($vConn, $vSqlModifDonnees);
	}

	$vSqlModifDonnees = "
		BEGIN TRANSACTION;
		UPDATE posseder SET quantite = quantite + $_POST[nombre] WHERE joueur='$pseudo' AND objet = '$_POST[nomObjet]'; 
		INSERT INTO effectuertransactionavec VALUES ('$vResult[pays]', '$pseudo', NOW(), $prixpotion);
		UPDATE joueur SET argent = argent - $prixpotion WHERE nom='$pseudo';
		COMMIT;";
	pg_query($vConn, $vSqlModifDonnees);
	
/*INSERT INTO posseder VALUES ('$pseudo', '$_POST[nomObjet]', 0);	
INSERT INTO posseder VALUES ('Arobaz', 'Potion de soin mineure', 0);*/

