<?php
echo $_POST['lonJ'];
echo $_POST['latJ'];
echo $_POST['nom'];
$date=date_default_timezone_set('UTC');
$vSql = "UPDATE Joueur SET coord_latitude=$_POST['latJ'],coord_longitude=$_POST['lonJ'],derniereconnexion=$date WHERE nom=$_POST['nom']";
$vQuery = pg_query($vConn,$vSql); 


?>



