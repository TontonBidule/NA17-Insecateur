<?php
	require_once("connexionBDD.php");
	$nomPokestop=$_POST['nomPokestop'];
	$url=$_POST['photo'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	if(empty($nomPokestop)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1".$_GET['pseudo']);
	}
	else{
		if(empty($url)){$url="NULL";}
		else{$url="'".$url."'";}
		if(empty($latitude)){$latitude="NULL";}
		if(empty($longitude)){$longitude="NULL";}
		$sql="INSERT INTO pokestop VALUES('".$nomPokestop."',".$url.",".$latitude.",".$longitude.");";
		$query=pg_query($vConn,$sql);
		include("deconnexionBDD.php");
		if($query){
			header("Location: administration.php?codeRetour=0".$_GET['pseudo']);
		}
		else{
			header("Location: administration.php?codeRetour=2".$_GET['pseudo']);
		}
	}
?>
