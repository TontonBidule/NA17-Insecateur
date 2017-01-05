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
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		if(!isset($numPokemon)){$numPokemon="NULL";}
		if(!isset($baseAttaque)){$baseAttaque="NULL";}
		if(!isset($baseDefense)){$baseDefense="NULL";}
		if(!isset($baseSante)){$baseSante="NULL";}
		if(!isset($pointCombat)){$pointCombat="NULL";}
		if(!isset($nomTypeSecondaire)){$nomTypeSecondaire="NULL";}
		else{$nomTypeSecondaire="'".$nomTypeSecondaire."'";}
		$sql="INSERT INTO EspecePokemon VALUES('".$nomPokemon."',".$numPokemon.",".$probabiliteApparition.",".$probabiliteCapture.",".$baseAttaque.",".$baseDefense.",".$baseSante.",".$pointCombat.",".$nomTypePokemon.",".$nomTypeSecondaire.",NULL);";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2");
		}
		if(isset($evolDe)){
			$sql="UPDATE EspecePokemon SET evolution='".$nomPokemon."WHERE nom='".$evolDe."';";
			$query=pg_query($vConn,$sql);
			if(!$query){
				include("deconnexionBDD.php");
				header("Location: administration.php?codeRetour=3");
			}
		}
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=0");
	}
?>
