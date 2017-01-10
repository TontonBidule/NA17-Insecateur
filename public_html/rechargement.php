
<html>

<?php
include('connexionBDD.php');
$pseudo=$_GET['pseudo'];

$vSql1 = "UPDATE Joueur SET nbPokemonsCapturesAjd=nbPokemonsCapturesAjd+1 WHERE nom='$pseudo'";
$vQuery1 = pg_query($vConn,$vSql1); 


if (empty($_POST['rechargement'])or $_POST['rechargement']<0)
{header('Location:achatShop?pseudo='.$pseudo);}
else
{

$rechargement=$_POST['rechargement'];	
$vSql1 = "UPDATE Joueur SET pokecoins=pokecoins+$rechargement WHERE nom='$pseudo'";
$vQuery1 = pg_query($vConn,$vSql1); 
echo "Vous venez de recharger $rechargement pokecoins";
	
}
echo "<br>";
echo "<br>";
echo '<a href="http://tuxa.sme.utc/~nf17a016/achatShop?pseudo='.$pseudo.'">Retourner dans le shop !</a>';
?>
 
</html>