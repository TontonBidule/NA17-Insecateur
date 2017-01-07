<?php
	include('connexionBDD.php');

	$pseudo = "Arobaz";
	$vSqlParamAdmin = "SELECT * FROM ParametresAdmin";
	$vQuery = pg_query($vConn, $vSqlParamAdmin);
	$vResultAdmin = pg_fetch_array($vQuery);
	$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('$pseudo', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	while($vResult = pg_fetch_array($vQuery)){
		echo"nom : $vResult[nom]\n";
		echo"\n";
	};
?>

