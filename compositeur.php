<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title> LISTE DES COMPOSITEURS </title>
	<meta charset = "utf-8">
	<meta name = "viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/script.js" language="javascript"></script>
</head>
	<body>
		<!--NAVBAR -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">LOgo</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php#myCarousel">ACCUEIL</a></li>
					<li><a href="index.php#about">À PROPOS</a></li>
					<li><a href="index.php#tousAlbums">TOUS ALBUMS</a></li>
					<?php
					if(empty($_SESSION["NOM_USER"]) && empty($_COOKIE["NOM_USER"]))
					{
						echo "<li><a href='index.php#connexion'>S'INSCRIRE</a></li>";
						echo "<li><a href='index.phph#connexion'>CONNEXION</a></li>";
					}
					else 
					{
						echo "<li><a  href=\"account.php\">". $nom."</a></li>";
						echo "<li><a  href=\"account.php\">PANIER</a></li>";
						echo "<li><a  href=\"./logout.php\">DÉCONNEXION</a></li>";
					}	
					?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-search"></span></a>
						<ul class="dropdown-menu">
							<li><a href="Compositeurs.php">Recherche par Compositeur </a></li>
							<li><a href="interprete.php">Recherche par Interprete</a></li>
							<li><a href="InstrumentC.php">Recherche par Instrument</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

		
	    </form>
	    <div class="container">
		<h2>LES MUSICIENS</h2>
		<p>Les musiciens magnifiques que vous aimez!</p>
		<form id="f" method="get" action="compositeur.php">
	       <input type="text" name ="compositeur" placeholder="Recherche par nom ou prenom du musicien"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button></input> 
		
		<?php
			$driver = 'sqlsrv';$host = 'INFO-SIMPLET';$nomDb = 'Classique_Web';
			$user = 'ETD';$password = 'ETD';
			$pdodsn = "$driver:Server=$host;Database=$nomDb";
			// Connexion PDO
			$pdo = new PDO($pdodsn, $user, $password);
			if (!isset($_GET['compositeur']))
				$query = "Select Nom_Musicien,Prénom_Musicien,Année_Naissance,Année_Mort,Code_Musicien from Musicien";
			else 
				$query = "Select Nom_Musicien,Prénom_Musicien,Année_Naissance,Année_Mort,Code_Musicien from Musicien WHERE Nom_Musicien LIKE '%" . $_GET['compositeur'] . "%' OR Prénom_Musicien LIKE '%" . $_GET['compositeur'] . "%'";
			echo 
			"<table class=\"table table-hover\">";
				echo"<thead><tr><th>NOM MUSICIEN</th><th>PRENOM MUSICIEN</th><th>ANNNEE NAISSANCE</th><th>ANNNEE MORT</th><th> PHOTO </th><th> ALBUMS CONCERNENT</th></tr></thead>";
				echo "<tbody>";
				foreach ($pdo->query($query) as $row) {
					echo "<form method=\"GET\" action=\"album-compositeur.php\">";
					echo "<tr> <td>" . $row[utf8_decode('Nom_Musicien')]."</td>";
					if (empty($row[utf8_decode('Prénom_Musicien')]))
					{
						echo "<td></td>";
						
					}
					else
					{
						echo "<td>".$row[utf8_decode('Prénom_Musicien')]."</td>";
					}

					if (empty($row[utf8_decode('Année_Naissance')]))
					{
						echo "<td></td>";
					}
					else {
						echo "<td>".$row[utf8_decode('Année_Naissance')]."</td>";
					}
					if (empty($row[utf8_decode('Année_Mort')]))
					{
						echo "<td></td>";
					}
					else {
						echo "<td>". $row[utf8_decode('Année_Mort')]."</td>";
					}
					echo "<td> <img src=\"image-compositeur.php?Code_Musicien=" . $row['Code_Musicien'] . "\" height=\"200\"> </td>";
					echo "<td> <a href=\"album-compositeur.php?code=" .$row['Code_Musicien']. "\"> Albums Concernant </a></td>";
					echo "</tr>";
				}
			echo "</tbody>";
			echo "</form></table>";
			$pdo = null;	
        ?>
    </div>
    </body> 
</html> 