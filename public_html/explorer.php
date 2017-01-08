<?php
	require_once("connexionBDD.php");
	$pseudo=$_GET['pseudo'];
	echo "-CAPTURE DES POKEMONS AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	include("capturePokemonFormulaire.php");
	echo"<br>";
	echo"<br>";
	echo "-VISITE DES POKESTOPS AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	include("visitePokestopFormulaire.php");
	echo"<br>";
	echo"<br>";
	echo "-VISITE DES ARENES AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	//include(areneEstProche.php);
?>