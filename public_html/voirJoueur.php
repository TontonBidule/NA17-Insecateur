<?php
	require_once("connexionBDD.php");
	$nom=$_POST['nomJoueur'];
	if(!isset($nom)){
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
			while(){}
		}
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=4");
	}
?>
