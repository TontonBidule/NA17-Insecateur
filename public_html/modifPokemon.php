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
	$evol=$_POST['evolution'];
	if(!isset($nomPokemon)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		$sql="UPDATE EspecePokemon SET";
		$virgule="";
		if(isset($numPokemon)){$sql=$sql.$virgule." numFamille=".$numPokemon;$virgule=",";}
		if(isset($probabiliteApparition)){$sql=$sql.$virgule." probaApparition=".$probabiliteApparition;$virgule=",";}
		if(isset($probabiliteCapture)){$sql=$sql.$virgule." probaCapture=".$probabiliteCapture;$virgule=",";}
		if(isset($evol)){$sql=$sql.$virgule." evolution='".$evol."'";$virgule=",";}
		if(isset($nomTypePokemon)){$sql=$sql.$virgule." type1='".$nomTypePokemon."'";$virgule=",";}
		if(isset($baseAttaque)){$sql=$sql.$virgule." baseAttaque=".$baseAttaque;$virgule=",";}
		if(isset($baseDefense)){$sql=$sql.$virgule." baseDefense=".$baseDefense;$virgule=",";}
		if(isset($baseSante)){$sql=$sql.$virgule." baseSante=".$baseSante;$virgule=",";}
		if(isset($pointCombat)){$sql=$sql.$virgule." capaciteCombatBase=".$pointCombat;$virgule=",";}
		if(isset($nomTypeSecondaire)){$sql=$sql.$virgule." type2='".$nomTypeSecondaire."'";$virgule=",";}
		$sql=$sql." WHERE nom='".$nomPokemon."';";
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
