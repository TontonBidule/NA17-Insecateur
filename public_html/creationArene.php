<?php
	require_once("connexionBDD.php");
	$nomArene=$_POST['nomAre'];
	$url=$_POST['photo'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	if(empty($nomArene)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		if(empty($url)){$url="NULL";}
		else{$url="'".$url."'";}
		if(empty($latitude)){$latitude="NULL";}
		if(empty($longitude)){$longitude="NULL";}
		$sql="INSERT INTO arene VALUES('".$nomArene."',".$url.",".$latitude.",".$longitude.");";
		$query=pg_query($vConn,$sql);
		include("deconnexionBDD.php");
		if(!$query){
			header("Location: administration.php?codeRetour=2");
		}
		else{
			header("Location: administration.php?codeRetour=0");
		}
	}
?>
