<?php
	include('connexionBDD.php');
	
	
	$pseudo = "Arobaz";
	$vSqlverifArgent = "SELECT pokecoins FROM Joueur WHERE nom='$pseudo'"; 
	$vQuery = pg_query($vConn, $vSqlverifArgent);
	$vResult = pg_fetch_array($vQuery);
	
	$prixtotal =  $_POST['nomObjet'] * $_POST['nombre'];
	
	
	if($vResult['pokecoins'] < $prixtotal){
		echo "Erreur, tu es peut etre un tres bon dresseur, mais tu n'as pas assez d'argent";
		echo '<a href="http://tuxa.sme.utc/~nf17a016/achatShop.php">Retour au magasin !</a>';
				
	}
	else
	{
	echo 'La transaction a bien ete effectuee o grand dresseur';}
	
	
	
	//$vSqlModifDonnees = "INSERT INTO effectuertransactionavec VALUES ('$vResult[pays]', '$pseudo', NOW(), $prixpotion);";
	//pg_query($vConn, $vSqlModifDonnees);
	//$vSqlModifDonnees = "UPDATE joueur SET argent = argent - $prixpotion WHERE nom='$pseudo'";
	//pg_query($vConn, $vSqlModifDonnees);
	
	//include('achatshop.php');
	






	/*$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('Arobaz', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom]\n";
		echo"\n";
	};*/
?>

