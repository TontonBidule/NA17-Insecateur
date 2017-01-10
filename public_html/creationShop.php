<?php
	require_once("connexionBDD.php");
	$pays=$_POST['pays'];
	if(empty($pays)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		$sql="INSERT INTO shop VALUES('".$pays."');";
		$query=pg_query($vConn,$sql);
		include("deconnexionBDD.php");
		if(!$query){
			header("Location: administration.php?codeRetour=2".$_GET['pseudo']);
		}
		else{
			header("Location: administration.php?codeRetour=0".$_GET['pseudo']);
		}
	}
?>
