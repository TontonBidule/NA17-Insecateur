<?php
	include('connexionBDD.php');


	$vSqlParamAdmin = "SELECT * FROM ParametresAdmin";
	$vQuery = pg_query($vConn, $vSqlParamAdmin);
	$vResultAdmin = pg_fetch_array($vQuery);
	$lim = $vResultAdmin['distancemaxpokestop'];
	$vSql = "SELECT nom FROM ArenesPotentielles('$pseudo', $lim)";
	$vQuery = pg_query($vConn, $vSql);
	
	if (empty($vResult = pg_fetch_array($vQuery)))
	{
		echo "Pas d'arenes a proximite...";
	}
	else
	{
	do{echo"nom : $vResult[nom]\n";
		echo"\n";}
	while($vResult = pg_fetch_array($vQuery));
		
	};
?>

