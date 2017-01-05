<?php
	require_once("connexionBDD.php");
	
	$pays=$_POST['pays'];
	if(!isset($pays)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		$sql="INSERT INTO shop VALUES('".$nomPays."');";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2");
		}
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=0");
	}
?>
