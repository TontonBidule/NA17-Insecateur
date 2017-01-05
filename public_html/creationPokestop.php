<?php
	require_once("connexionBDD.php");
	$nomPokestop=$_POST['nomPokestop'];
	$url=$_POST['url'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	if(!isset($nomPokestop)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		if(!isset($url)){$url="NULL";}
		else{$url="'".$url."'";}
		if(!isset($latitude)){$latitude="NULL";}
		if(!isset($longitude)){$longitude="NULL";}
		$sql="INSERT INTO pokestop VALUES('".$nomPokestop."',".$url.",".$latitude.",".$longitude");";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2");
		}
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=0");
	}
?>
