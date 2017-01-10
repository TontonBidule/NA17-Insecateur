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
	if(empty($nomPokemon)||empty($probabiliteApparition)||empty($probabiliteCapture)||empty($nomTypePokemon)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1&pseudo=".$_GET['pseudo']);
	}
	else{
		if(empty($numPokemon)){$numPokemon="NULL";}
		if(empty($baseAttaque)){$baseAttaque="NULL";}
		if(empty($baseDefense)){$baseDefense="NULL";}
		if(empty($baseSante)){$baseSante="NULL";}
		if(empty($pointCombat)){$pointCombat="NULL";}
		if(empty($nomTypeSecondaire)){$nomTypeSecondaire="NULL";}
		else{$nomTypeSecondaire="'".$nomTypeSecondaire."'";}
		$sql="INSERT INTO EspecePokemon VALUES('".$nomPokemon."',".$numPokemon.",".$probabiliteApparition.",".$probabiliteCapture.",".$baseAttaque.",".$baseDefense.",".$baseSante.",".$pointCombat.",'".$nomTypePokemon."',".$nomTypeSecondaire.",NULL);";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2".$_GET['pseudo']);
		}
		else if(!empty($evolDe)){
			$sql="UPDATE EspecePokemon SET evolution='".$nomPokemon."'WHERE nom='".$evolDe."';";
			$query=pg_query($vConn,$sql);
			if(!$query){
				include("deconnexionBDD.php");
				header("Location: administration.php?codeRetour=3".$_GET['pseudo']);
			}
			else{
				header("Location: administration.php?codeRetour=0".$_GET['pseudo']);
			}
		}else{
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=0".$_GET['pseudo']);
		}
	}
?>
