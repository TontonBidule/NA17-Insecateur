<?php
include ('connexionBDD.php');
$lonJ= $_POST['lonJ'];
$latJ =$_POST['latJ'];
$pseudo='Arobaz';
echo $lonJ;
//echo $_POST['nom'];

$vSql = "UPDATE Joueur SET coord_latitude=$latJ,coord_longitude=$lonJ,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='Arobaz'";
$vQuery = pg_query($vConn,$vSql); 

echo "Vous etes connectes desormais !";
echo "<br> <br>";
echo '<a href="http://tuxa.sme.utc/~nf17a016/index.html?pseudo=$pseudo">Jouer !</a>';

//UPDATE Joueur SET coord_latitude=10,coord_longitude=12,derniereconnexion=CURRENT_TIMESTAMP WHERE nom='Arobaz';

?>



