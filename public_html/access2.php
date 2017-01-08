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
 
<div id="content" style="display:table;margin:0 auto;background-color:#EEEEEE;height:550px;width:750px;float:left;">
<?php
	$nom= null;
	$email= null;
	$messageErr = "";
	if(!empty($_POST["nom"])){
		$nom= $_POST["nom"];
	}
	if(!empty($_POST["email"])){
		$email= $_POST["email"];
	}
	if(empty($nom) || empty($email)){
		$messageErr = "Les champs avec * sont obligatoires.";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$messageErr = "Le format de l'adresse email n'est pas correcte.";
	}
	if($messageErr == ""){
		if(!isset($engineLoaded)){
			$engineLoaded = true;
			include('connexionBDD.php');
		}
		$vSql ="SELECT * FROM Joueur WHERE nom = '".$nom."' AND email = '".$email."'";
		
		$vQuery=pg_query($vConn, $vSql);
		if($result = pg_fetch_array($vQuery)){
			include("enregistrementGPS.php");
		}
		else{
			echo "<div style = 'display:table-cell; vertical-align:middle;'>
			<center><table>
			<tbody>";
			echo "<tr><td>Vérifier votre nom et email, svp!</tr></td>";
			echo "<tr><td><button onclick ='history.go(-1);' >Retourner</button></tr></td>";
			echo "</tbody>
			</table></center>
			</div>";
		}
	}
	else{
		echo "<div style = 'display:table-cell; vertical-align:middle;'>
			<center><table>
			<tbody>";
		echo "<tr><td>".$messageErr."</tr></td>";
		echo "<tr><td><button onclick ='history.go(-1);' >Retourner</button></tr></td>";
		echo "</tbody>
			</table></center>
			</div>";
	}

?>
</div>
 
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>