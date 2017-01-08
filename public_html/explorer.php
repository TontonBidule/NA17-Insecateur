
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      	<title>Exploration en milieu naturel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<?php
 if (!isset($_GET['pseudo']))
{
	echo "Vous n'etes pas connectes !<br><br>";
	echo '<a href="http://tuxa.sme.utc/~nf17a016/accessJoueur.php">Connexion !</a>';
}
else
{
	include("index.php");
	echo "</div>";
	echo "<div id='content' style='background-color:#EEEEEE;height:550px;width:750px;float:left;overflow:auto;'>";
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
	echo"<br>";}
	//include(areneEstProche.php);
?>
</div>
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>

</div>
</body>
</html>

