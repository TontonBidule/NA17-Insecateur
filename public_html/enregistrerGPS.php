<?php
header('Location: pokemonEstProche.php');
session_start();
echo $_POST['lonJ'];
echo $_POST['latJ'];
$_SESSION['lonJ']= $_POST['lonJ'];
$_SESSION['latJ']= $_POST['latJ'];
?>



