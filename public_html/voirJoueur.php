<?php
	require_once("connexionBDD.php");
	$nom=$_GET['nomJoueur'];
	if(empty($nom)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		$sql="SELECT * FROM Joueur WHERE nom='".$nom."';";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2");
		}
		else{
			$vRes=pg_fetch_array($query);
			$envoi="Location: administration.php?codeRetour=4";
			$envoi=$envoi."&nom=".$vRes['nom'];
			$envoi=$envoi."&email=".$vRes['email'];
			$envoi=$envoi."&datenaissance=".$vRes['datenaissance'];
			$envoi=$envoi."&genre=".$vRes['genre'];
			$envoi=$envoi."&pays=".$vRes['pays'];
			$envoi=$envoi."&experiencecumulee=".$vRes['experiencecumulee'];
			$envoi=$envoi."&coord_latitude=".$vRes['coord_latitude'];
			$envoi=$envoi."&coord_longitude=".$vRes['coord_longitude'];
			$envoi=$envoi."&nbpokestopsvisitesajd=".$vRes['nbpokestopsvisitesajd'];
			$envoi=$envoi."&nbpokemonscapturesajd=".$vRes['nbpokemonscapturesajd'];
			$envoi=$envoi."&derniereconnexion=".$vRes['derniereconnexion'];
			$envoi=$envoi."&pokecoins=".$vRes['pokecoins'];
			$envoi=$envoi."&argent=".$vRes['argent'];
			include("deconnexionBDD.php");
			header($envoi);
		}
	}
?>
