<?php
	require_once("connexionBDD.php");
	
	echo "-CAPTURE DES POKEMONS AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	include("pokemonEstProche.php");
	echo"<br>";
	echo"<br>";
	echo "-VISITE DES POKESTOPS AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	include("pokestopEstProche.php");
	echo"<br>";
	echo"<br>";
	echo "-VISITE DES ARENES AUX ALENTOURS -";
	echo"<br>";
	echo"<br>";
	//include(areneEstProche.php);
?>