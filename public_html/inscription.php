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
		<td>
		<center>Administration</center>
		</td>
	</tr>
</table>
</div>
 
<div id="content" style="background-color:#EEEEEE;height:550px;width:750px;float:left;">
<center><div><h3>Inscription de Joueur</h3></div></center>
<center><div>
<form action = "inscription2.php" method = "POST">
<table>
	<tr>
		<td>Nom * : </td>
		<td><input type = "text" name = "nom"></td>
	</tr>
	<tr>
		<td>Email * : </td>
		<td><input type = "text" name = "email"></td>
	</tr>
	
	<tr>
		<td>Date de naissance(format:1992/06/06) * : </td>
		<td><input type = "date" name = "dateNaissance"></td>
	</tr>
	<tr>
		<td>Genre * : </td>
		<td>
		<input type = "radio" name = "genre" value = "masculin">Garçon
		<input type = "radio" name = "genre" value = "feminin">Fille
		</td>
	</tr>
	<tr>
		<td>Pays:</td>
		<td> <input type = "text" name = "pays"></td>
	</tr>
	
	<tr>
		<td>
		Position au début:<td/>
		<td></td>
	</tr>
	<tr>
		<td>Longitude * :</td>
		<td>
		 <input type = "text" name = "coord_longitude">
		</td>
	</tr>
	<tr>
		<td>Latitude * :</td>
		<td><input type = "text" name = "coord_lattitude"></td>
	</tr>
	<tr>
		<td>(Les champs avec * sont obligatoires.)</td>
	</tr>
	</table>

<br>
<input type = "submit" value = "Inscription" >
</form>
</div></center>
</div>
 
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>