
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Panneau d'Administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
 
<div id="container" style="width:900px">
 
<div id="header" style="background-color:#fafad2;">
	<center><h1 style="margin-bottom:0;">Pokemon Go</h1></center>
</div>
 
<div id="menu" style="background-color:#778899;height:550px;width:150px;float:left;">
<table>
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
<center><div><h3>Bienvenue dans le monde de Pokémon!</h3></div></center>
<center><div><img src="PokemonIndex.jpg" width="600"/></div></center>
</div>
<div style="background-color:#fafad2;"><center><b>Les champs avec "<font color="red">★</font>" sont obligatoires  </b></center></div>	
<?php
	if(isset($_GET['codeRetour'])){	
		echo "<div style='background-color:#FF0000;'>";
		if($_GET['codeRetour']==4){
                        echo "Nom:".$_GET['nom']."<br/>";
                        echo "Email:".$_GET['email']."<br/>";
                        echo "Date naissance:".$_GET['datenaissance']."<br/>";
                        echo "Genre:".$_GET['genre']."<br/>";
                        echo "Pays:".$_GET['pays']."<br/>";
                        echo "Experience:".$_GET['experiencecumulee']."<br/>";
                        echo "Latitude:".$_GET['coord_latitude']."<br/>";
                        echo "Longitude:".$_GET['coord_longitude']."<br/>";
                        echo "Nombre de pokestops visitées aujourd'hui:".$_GET['nbpokestopsvisitesajd']."<br/>";
                        echo "Nombre de pokemon capturés aujourd'hui:".$_GET['nbpokemonscapturesajd']."<br/>";
                        echo "Dernière connexion:".$_GET['derniereconnexion']."<br/>";
                        echo "Pokecoins:".$_GET['pokecoins']."<br/>";
                        echo "Argent:".$_GET['argent']."<br/>";
                }else{echo"<center>";
			if($_GET['codeRetour']==1){echo "Merci de remplir tous les champs obligatoires";}
			else if($_GET['codeRetour']==0){echo "Opération réussi avec succès";}
			else if($_GET['codeRetour']==2){echo "Une erreur c'est produite";}
			else if($_GET['codeRetour']==3){echo "Evolution introuvable";}
			else if($_GET['codeRetour']==4){
				echo "Nom:".$_GET['nom']."<br/>";
                        	echo "Email:".$_GET['email']."<br/>";
                        	echo "Date naissance:".$_GET['datenaissance']."<br/>";
                        	echo "Genre:".$_GET['genre']."<br/>";
                        	echo "Pays:".$_GET['pays']."<br/>";
                        	echo "Experience:".$_GET['experiencecumulee']."<br/>";
                        	echo "Latitude:".$_GET['coord_latitude']."<br/>";
                        	echo "Longitude:".$_GET['coord_longitude']."<br/>";
                        	echo "Nombre de pokestops visitées aujourd'hui:".$_GET['nbpokestopsvisitesajd']."<br/>";
                        	echo "Nombre de pokemon capturés aujourd'hui:".$_GET['nbpokemonscapturesajd']."<br/>";
                        	echo "Dernière connexion:".$_GET['derniereconnexion']."<br/>";
                        	echo "Pokecoins:".$_GET['pokecoins']."<br/>";
                        	echo "Argent:".$_GET['argent']."<br/>";
			}
			echo "</center>";
		}
		echo "</div>";
	}
?>
<div id="form" style="background-color:#778899;">
	<table border="1"><tr><td>
	<form method="POST" Action="creationPokemon.php">
		<p><font color="red">★</font>Nom Pokémon:<input type="text" name="nomPok"/></p>
		<p>Num Famille:<input type="number" step="1" min="0" name="numFam"/></p>
		<p><font color="red">★</font>Probabilité Apparition:<input type="number" max="0.1" min="0" step="0.000001" name="probaApp"/></p>
		<p><font color="red">★</font>Probabilité Capture:<input type="number" max="0.9" min ="0" step="0.000001" name="probaCap"/></p>
		<p>Base Attaque:<input type="number" min="1" max="10000" step="1" name="baseAtt"/></p>
		<p>Base Defense:<input type="number" min="1" max="10000" step="1" name="baseDef"/></p>
		<p>Base Sante:<input type="number" min="1" max="10000" step="1" name="baseSante"/></p>
		<p>Capacité de Combat:<input type="number" min="1" max="10000" step="1" name="pc"/></p>
		<p><font color="red">★</font>Type de Pokémon:<input type="text" name="type1"/></p>
		<p>Deuxième type de Pokémon:<input type="text" name="type2"/></p>
		<p>Evolution de (nom):<input type="text" name="nomEvolDe"/></p>
		<input type="submit" value="Créer"/>
	</form></td><td>
	<form method="POST" Action="creationArene.php">
		<p><font color="red">★</font>nom Arène:<input type="text" name="nomAre"/></p>
		<p>Photo (insérer une url):<input type="url" name="photo"/></p>
		<p>Latitude:<input type="number" name="latitude" step="any"/></p>
		<p>Longitude:<input type="number" name="longitude" step="any"/></p>
		<input type="submit" value="Créer"/>
	</form></td><td>
	<form method="POST" Action="creationPokestop.php">
		<p><font color="red">★</font>Nom Pokéstop:<input type="text" name="nomPokestop"/></p>
		<p>Photo (insérer une url):<input type="url" name="photo"/></p>
		<p>Latitude:<input type="number" name="latitude" step="any"/></p>
		<p>Longitude:<input type="number" name="longitude" step="any"/></p>
		<input type="submit" value="Créer"/>
	</form></td></tr><tr><td>
	<form method="POST" Action="creationShop.php">
		<p><font color="red">★</font>Pays:<input type="text" name="pays"/></p>
		<input type="submit" value="Créer"/>
	</form></td><td>
	<form method="POST" Action="modifPokemon.php">
		<p><font color="red">★</font>Nom Pokémon:<input type="text" name="nomPok"/></p>
		<p>Num Famille:<input type="number" step="1" min="0" name="numFam"/></p>
		<p>Probabilité Apparition:<input type="number" max="0.1" step="any" name="probaApp"/></p>
		<p>Probabilité Capture:<input type="number" max="0.1" step="any"name="probaCap"/></p>
		<p>Base Attaque:<input type="number" min="0" max="15" step="any" name="baseAtt"/></p>
		<p>Base Defense:<input type="number" min="0" max="15" step="any" name="baseDef"/></p>
		<p>Base Sante:<input type="number" min="0" max="15" step="any" name="baseSante"/></p>
		<p>Capacité de Combat:<input type="number" min="0" max="10000" step="1" name="pc"/></p>
		<p>Type de Pokémon:<input type="text" name="type1"/></p>
		<p>Deuxième type de Pokémon:<input type="text" name="type2"/></p>
		<p>Evolution (nom):<input type="text" name="evolution"/></p>
		<input type="submit" value="Modifier"/>
	</form></td><td>
	<form method="GET" Action="voirJoueur.php">
		<p><font color="red">★</font>Nom Joueur:<input type="text" name="nomJoueur"/></p>
		<input type="submit" value="Visualier"/>
	</form></td></tr>
	</table>
</div>
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>
