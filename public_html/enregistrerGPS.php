<?php
include ('connexionBDD.php');
$pseudo=$_GET['pseudo'];
if (empty($_POST['lonJ']) OR empty($_POST['latJ']))
{
	header('Location:access2.php?pseudo='.$pseudo);
}
else
{
$lonJ= $_POST['lonJ'];
$latJ =$_POST['latJ'];
echo $lonJ;
//echo $_POST['nom'];

echo $pseudo;
$vSql = "UPDATE Joueur SET coord_latitude=$latJ,coord_longitude=$lonJ,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='$pseudo'";
$vQuery = pg_query($vConn,$vSql); 

echo "Vous etes connectes desormais !";
echo "<br> <br>";
echo '<a href="index.php?pseudo='.$pseudo.'">Jouer !</a>';
}

//UPDATE Joueur SET coord_latitude=10,coord_longitude=12,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='Arobaz';

?>



