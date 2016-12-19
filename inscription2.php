<html>

<body>

<?php

	echo $_POST["nom"]."<br>";
	echo $_POST["email"]."<br>";
	echo $_POST["dateNaissance"]."<br>";
	echo $_POST["genre"]."<br>";
	echo $_POST["pays"]."<br>";
	echo $_POST["coord_longitude"]."<br>";
	echo $_POST["coord_lattitude"]."<br>";
	
	$nom= $_POST["nom"];
	$email= $_POST["email"];
	$dateNaissance= $_POST["dateNaissance"];
	$genre= $_POST["genre"];
	$pays= $_POST["pays"];
	$clo= $_POST["coord_longitude"];
	$cla= $_POST["coord_lattitude"];
	
	$vHost = "localhost";
	$vPort = 5432;
	$vDbname = "postgres";
	$vPassword = "a13241324";
	$vUser = "postgres";
	$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
	$vSql ="INSERT INTO joueur (nom, email, dateNaissance, genre, pays, coord_longitude, coord_lattitude) VALUES ('".
		$nom."', '".
		$email."', '".
		$dateNaissance."', '".
		$genre."', '".
		$pays."', '".
		$clo."', '".
		$cla."'"
		.")";
	echo $vSql;
	$vQuery=pg_query($vConn, $vSql);
?>
</body>
</html>