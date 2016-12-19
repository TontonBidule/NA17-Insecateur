<html>
<body>

<h2>Inscription de Joueur</h2>
<form action = "inscription2.php" method = "POST"><br>
Nom: <input type = "text" name = "nom"><br>
Email: <input type = "text" name = "email"><br>
Date de naissance(format:1992/06/06): <input type = "date" name = "dateNaissance"><br>
Genre: <br>
<input type = "radio" name = "genre" value = "masculin">Garçon<br>
 <input type = "radio" name = "genre" value = "feminin">Fille<br>
Pays: <input type = "text" name = "pays"><br>
Position au début:<br>
Longitude: <input type = "text" name = "coord_longitude">
<br>
Latitude: <input type = "text" name = "coord_lattitude">
<br>
<input type = "submit" value = "Inscription" >
</form>
</body>
</html>