<html>

<body>
 
<div id="container" style="width:900px">
 
<div id="header" style="background-color:#fafad2;">
	<center><h1 style="margin-bottom:0;">Pokemon Go</h1></center>
</div>
 
<div id="menu" style="background-color:#778899;height:550px;width:150px;float:left;">

<table>
<tr>
<td onclick = "window.location = 'accessJoueur.php<?php if(isset($_GET['pseudo'])){echo "?pseudo=$_GET[pseudo]";} ?>'">
<center>Acceder</center>
		</td>
</tr>
<tr>
<td onclick = "window.location = 'inscription.php<?php if(isset($_GET['pseudo'])){echo "?pseudo=$_GET[pseudo]";} ?>'">
<center>Inscripton</center>
		</td>
</tr>
<tr>
<td onclick = "window.location = 'explorer.php<?php if(isset($_GET['pseudo'])){echo "?pseudo=$_GET[pseudo]";} ?>'">
<center>Administration</center>
		</td>
</tr>
<tr>
<td onclick = "window.location = 'administration.php<?php if(isset($_GET['pseudo'])){echo "?pseudo=$_GET[pseudo]";} ?>'">
<center>Explorer</center>
		</td>
</tr>
<td onclick = "window.location = 'achatshop.php<?php if(isset($_GET['pseudo'])){echo "?pseudo=$_GET[pseudo]";} ?>'">
<center>Acheter</center>
		</td>
</tr>

</table>
</div>
 
<div id="content" style="background-color:#EEEEEE;height:550px;width:750px;float:left;">
<center><div><h3>Bienvenue dans le monde de Pokemon TEST!</h3></div></center>
<center><div><img src="PokemonIndex.jpg" width="600"/></div></center>
</div>
 
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>