<?php
	require_once("connexionBDD.php");
	$nomPokemon=$_POST['nomPok'];
	$numPokemon=$_POST['numFam'];
	$probabiliteApparition=$_POST['probaApp'];
	$probabiliteCapture=$_POST['probaCap'];
	$baseAttaque=$_POST['baseAtt'];
	$baseDefense=$_POST['baseDef'];
	$baseSante=$_POST['baseSante'];
	$pointCombat=$_POST['pc'];
	$nomTypePokemon=$_POST['type1'];
	$nomTypeSecondaire=$_POST['type2'];
	$evolDe=$_POST['nomEvolDe'];
	if(!isset($nomPokemon)||!isset($probabiliteApparition)||!isset($probabiliteCapture)||!isset($nomTypePokemon)){
		header("Location: administration.php?codeRetour=-1");
	}
	else{
		$sql="INSERT INTO EspecePokemon VALUES('".$nomPokemon."',".$numPokemon.",".$probabiliteApparition.",".$probabiliteCapture.",".$baseAttaque.",".$baseDefense.",".$baseSante.",".$pointCombat.",".$nomTypePokemon.",".$nomTypeSecondaire.",NULL);";
		$query=pg_query($vConn,$sql);


		if(isset($evolDe)){
			$sql="UPDATE EspecePokemon SET evolution='".$nomPokemon."WHERE nom='".$evolDe."';";
		}
	}
	include("deconnexionBDD.php");
?>
