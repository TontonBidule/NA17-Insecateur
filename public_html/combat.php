
<html>

<?php
include('connexionBDD.php');
$pseudo=$_GET['pseudo'];
$arene=$_POST['arene'];

$vSql1 = "SELECT * FROM CombattreDans WHERE arene='$arene' AND joueur='$pseudo';";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);

if (empty($vResult1))
{
$vSql1 = "INSERT INTO CombattreDans VALUES ('$arene','$pseudo')";
$vQuery1 = pg_query($vConn,$vSql1); 
$vResult1 = pg_fetch_array($vQuery1);
echo "Combat effectue !";
}
else
{
	echo "Vous avez deja combattu dans cette arene";
}


echo "<br>";
echo '<a href="http://tuxa.sme.utc/~nf17a016/explorer.php?pseudo='.$pseudo.'">Continuer a explorer !</a>';
?>
 
</html>