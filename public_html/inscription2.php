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
	$dateNaissance= null;
	$genre= null;
	$pays= null;
	$clo= null;
	$cla= null;
	$messageErr = "";
	if(!empty($_POST["nom"])){
		$nom= $_POST["nom"];
	}
	if(!empty($_POST["email"])){
		$email= $_POST["email"];
	}
	if(!empty($_POST["dateNaissance"])){
		$dateNaissance= $_POST["dateNaissance"];
	}
	if(!empty($_POST["genre"])){
		$genre= $_POST["genre"];
	}
	if(!empty($_POST["pays"])){
		$pays= $_POST["pays"];
	}
	if($_POST["coord_longitude"]==0 || !empty($_POST["coord_longitude"])){
		$clo= $_POST["coord_longitude"];
	}
	if($_POST["coord_latitude"]==0 || !empty($_POST["coord_latitude"])){
		$cla= $_POST["coord_latitude"];
	}
	
	if(empty($nom) || empty($email)|| (!($_POST["coord_longitude"]==0) && empty($clo))|| (!($_POST["coord_latitude"]==0) && empty($cla)) || empty($dateNaissance) || empty($genre)){
		$messageErr = "Les champs avec * sont obligatoires.";
	}
	else if(!is_numeric($clo) || !is_numeric($cla)){
		$messageErr = "Les GPS doivent être numéro.";
	}
	else if(!is_numeric($clo) || !is_numeric($cla)){
		$messageErr = "Les GPS doivent être numéro.";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$messageErr = "Le format de l'adresse email n'est pas correcte.";
	}?>
	<div style = 'display:table-cell; vertical-align:middle;'>
	<center><table>
	<tbody>
	<?php
	if($messageErr == ""){
		if(!isset($engineLoaded))
		{
		$engineLoaded = true;
		include('connexionBDD.php');
		}
		$vSql ="INSERT INTO joueur  VALUES ('".$nom."', '".$email."', '".$dateNaissance."', '".$genre."', '".$pays."', 0,'".$clo."', '".$cla."',0,0,CURRENT_TIMESTAMP,0,0)";
		//echo $vSql;
		$vQuery=pg_query($vConn, $vSql);
		if($vQuery){
			echo "<tr><td>Inscription avec succés!</td></tr>";
			echo "<tr><td><button onclick =\"window.location = 'accessJoueur.php?pseudo=".$nom."'\" >Retourner</button></tr></td>";
		}
		else{
			$Err = pg_ErrorMessage();
			if(stripos($Err, "coord_latitude") || stripos($Err, "coord_longitude")){
				$messageErr = "Le GPS a été occupé par un autre joueur.";
			}
			else if(stripos($Err, "nom")){
				$messageErr = "Le nom a été utilisé par un autre joueur.";
			}
			else if(stripos($Err, "email")){
				$messageErr = "L'email a été utilisé par un autre joueur.";
			}
			echo "<tr><td>".$messageErr."</tr></td>";
			echo "<tr><td><button onclick ='history.go(-1);' >Retourner</button></tr></td>";
		}
	}
	else{
		echo "<tr><td>".$messageErr."</tr></td>";
		echo "<tr><td><button onclick ='history.go(-1);' >Retourner</button></tr></td>";
	}
	?>
	</tbody>
	</table></center>
	</div>
</div>
 
<div id="footer" style="background-color:#fafad2;clear:both;text-align:center;">
Equipe I de NA17
</div>
 
</div>
</body>
</html>
