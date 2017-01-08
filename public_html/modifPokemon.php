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
	if(empty($nomPokemon)){
		include("deconnexionBDD.php");
		header("Location: administration.php?codeRetour=1");
	}
	else{
		$sql="UPDATE EspecePokemon SET";
		$virgule="";
		if(!empty($numPokemon)){$sql=$sql.$virgule." numFamille=".$numPokemon;$virgule=",";}
		if(!empty($probabiliteApparition)){$sql=$sql.$virgule." probaApparition=".$probabiliteApparition;$virgule=",";}
		if(!empty($probabiliteCapture)){$sql=$sql.$virgule." probaCapture=".$probabiliteCapture;$virgule=",";}
		if(!empty($evol)){$sql=$sql.$virgule." evolution='".$evol."'";$virgule=",";}
		if(!empty($nomTypePokemon)){$sql=$sql.$virgule." type1='".$nomTypePokemon."'";$virgule=",";}
		if(!empty($baseAttaque)){$sql=$sql.$virgule." baseAttaque=".$baseAttaque;$virgule=",";}
		if(!empty($baseDefense)){$sql=$sql.$virgule." baseDefense=".$baseDefense;$virgule=",";}
		if(!empty($baseSante)){$sql=$sql.$virgule." baseSante=".$baseSante;$virgule=",";}
		if(!empty($pointCombat)){$sql=$sql.$virgule." capaciteCombatBase=".$pointCombat;$virgule=",";}
		if(!empty($nomTypeSecondaire)){$sql=$sql.$virgule." type2='".$nomTypeSecondaire."'";$virgule=",";}
		$sql=$sql." WHERE nom='".$nomPokemon."';";
		$query=pg_query($vConn,$sql);
		if(!$query){
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=2");
		}
		if(!empty($evolDe)){
			$sql="UPDATE EspecePokemon SET evolution='".$nomPokemon."WHERE nom='".$evolDe."';";
			$query=pg_query($vConn,$sql);
			include("deconnexionBDD.php");
			if(!$query){
				header("Location: administration.php?codeRetour=3");
			}
			else{
				header("Location: administration.php?codeRetour=0");
			}
		}else{
			include("deconnexionBDD.php");
			header("Location: administration.php?codeRetour=0");
		}
	}
?>
