<?php
include ('connexionBDD.php');
$lonJ= $_POST['lonJ'];
$latJ =$_POST['latJ'];
echo $lonJ;
//echo $_POST['nom'];
$pseudo=$_GET['pseudo'];
echo $pseudo;
$vSql = "UPDATE Joueur SET coord_latitude=$latJ,coord_longitude=$lonJ,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='$pseudo'";
$vQuery = pg_query($vConn,$vSql); 

echo "Vous etes connectes desormais !";
echo "<br> <br>";
echo '<a href="index.php?pseudo='.$pseudo.'">Jouer !</a>';

//UPDATE Joueur SET coord_latitude=10,coord_longitude=12,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='Arobaz';

?>



