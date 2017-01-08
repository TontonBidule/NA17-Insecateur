<html>
<body>

<div id="container" style="width:900px">
 
<div id="header" style="background-color:#fafad2;">
	<center><h1 style="margin-bottom:0;">Pokemon Go</h1></center>
</div>
 
<div id="menu" style="background-color:#778899;height:550px;width:150px;float:left;">
<table>
	<tr>
		<td>
		<center>Menu</center>
		</td>
	</tr>
	<tr>
		<td onclick = "window.location = 'accessJoueur.php'">
		<center>Accéder</center>
		</td>
	</tr>
	<tr>
		<td onclick = "window.location = 'inscription.php'">
		<center>Inscription</center>
		</td>
	</tr>
	<tr>
		<td onclick = "windows.location = 'administration.php'">
		<center>Administration</center>
		</td>
	</tr>
</table>
</div>
 
<div id="content" style="background-color:#EEEEEE;height:550px;width:750px;float:left;">

<?php
if (isset($_GET['pseudo']))
{
	$pseudo=$_GET['pseudo'];
	echo $pseudo;
	echo "Vous etes deja connectes !";
	echo '<a href="http://tuxa.sme.utc/~nf17a016/index.php?pseudo='.$pseudo.'">Retour au menu !</a>';
}
else
{
	echo "<center><div><h3>Accéder avec vos nom et email</h3></div></center>";
	echo "<center><div>";
	echo "<form action = 'access2.php' method = 'POST'>";
	echo "<table>";
	echo "	<tr>";
	echo "		<td>*Nom: </td>";
	echo "		<td><input type = 'text' name = 'nom'></td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td>*Email: </td>";
	echo "		<td><input type = 'text' name = 'email'></td>";
	echo "	</tr>";
	echo "	</table>";
	echo "<br>";
	echo "<input type = 'submit' value = 'Acceder' >";
	echo "</form>";
	echo "</div>";
	echo "</center>";
}
?>
</div>
 
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>
