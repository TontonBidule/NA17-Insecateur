<?php
	include('connexionBDD.php');
	include('index.php');
	
	$pseudo = $_GET['pseudo'];
	$objet=$_POST['nomObjet'];
	$somme=$_POST['somme'];
	$nombre=$_POST['nombre'];
	$vSqlExistanceObjet = "SELECT prixargentreel(o.nom), s.pays pays, j.argent
			FROM Objet o, Vendre v, joueur j, shop s
			WHERE o.type='achetable' AND o.nom = '$objet' AND  v.objet = o.nom AND v.shop = s.pays AND j.pays = s.pays;"; 
	$vQuery = pg_query($vConn, $vSqlExistanceObjet);
	
	$vResult = pg_fetch_array($vQuery);
	$prixpotion =  $vResult["prixargentreel"] * $_POST['nombre'];
	
	if ((empty($_POST['nombre'])) or (empty($_POST['nomObjet'])))
	{
		header('Location:achatShop.php?pseudo='.$pseudo);
	}
	
	if($somme<$prixpotion){
		echo "erreur, tu es peut etre un tres bon dresseur, mais tu n as pas assez d'argent";
		echo "<br><br>";
		echo '<a href="achatShop.php?pseudo='.$pseudo.'">Retour au shop !</a>';
		exit();	
	}
	else{
	echo 'La transaction a bien ete effectuee !';
	echo '<br>';
	

	$vSqltentative="SELECT * FROM Posseder WHERE joueur='$pseudo' AND objet='$objet'";
	$vQuery = pg_query($vConn, $vSqltentative);
	if(empty($vResult2 = pg_fetch_array($vQuery))){
		$vSqlModifDonnees = "INSERT INTO Posseder VALUES ('$pseudo', '$objet', $nombre);";
		pg_query($vConn, $vSqlModifDonnees);
	}

	$vSqlModifDonnees = "
		BEGIN TRANSACTION;
		UPDATE posseder SET quantite = quantite + $_POST[nombre] WHERE joueur='$pseudo' AND objet = '$_POST[nomObjet]'; 
		INSERT INTO effectuertransactionavec VALUES ('$vResult[pays]', '$pseudo', NOW(), $prixpotion);
		UPDATE joueur SET pokecoins = pokecoins - $prixpotion WHERE nom='$pseudo';
		COMMIT;";
	pg_query($vConn, $vSqlModifDonnees);
	}
	
echo "<br>";
echo '<a href="http://tuxa.sme.utc/~nf17a016/achatShop?pseudo='.$pseudo.'">Retourner dans le shop !</a>';
	
/*INSERT INTO posseder VALUES ('$pseudo', '$_POST[nomObjet]', 0);	
INSERT INTO posseder VALUES ('Arobaz', 'Potion de soin mineure', 0);*/

