<?php

	require_once("connexionBDD.php");
		$sql="SELECT pokeSauvageApparait();";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2".$_GET['pseudo']);
		}else{
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=0".$_GET['pseudo']);
		}

?>
