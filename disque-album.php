<!DOCTYPE html>
<html>
<head>
	<title> LISTE DES DISQUES </title>
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

<div class="container">
		<h2>LES DISQUES</h2>
		<p>Les disques de votre album préféré</p>
	<?php
		$driver = 'sqlsrv';
		$host = 'INFO-SIMPLET';
		$nomDb = 'Classique_Web';
		$user = 'ETD'; $password = 'ETD';
		// Chaine de connexion
		$pdodsn = "$driver:Server=$host; Database=$nomDb";
		// Connexion PDO
		$pdo = new PDO($pdodsn, $user, $password);
		$query = "select Enregistrement.Titre,Enregistrement.Code_Morceau 
 			      FROM Album INNER JOIN (Disque INNER JOIN (Composition_Disque INNER JOIN Enregistrement ON Composition_Disque.Code_Morceau = Enregistrement.Code_Morceau) ON Disque.Code_Disque = Composition_Disque.Code_Disque) ON Album.Code_Album = Disque.Code_Album
                  WHERE Album.Code_Album = " . $_GET["Code_Album"];
        $query2 = "Select Titre_Album,Année_Album,Code_Album from Album WHERE Code_Album =". $_GET["Code_Album"];
        foreach ($pdo->query($query2) as $row1)
        {
        	echo  "<p><strong>TITRE: </strong>".$row1['Titre_Album']."</p>";
			echo  "<p><strong>ANNÉE: </strong>".$row1[utf8_decode('Année_Album')]."</p>";
			echo "<p><img src=\"image-album.php?Code_Album=" . $row1['Code_Album'] . "\" height=\"100\"></p>";
        }
		echo 
			"<table class=\"table table-hover\">";
				echo"<thead><tr><th>TITRE MORCEAU</th><th>EXTRAIT</th><th>PRIX UNITAIRE</th></tr></thead>";
				echo "<tbody>";
				foreach ($pdo->query($query) as $row) {
        echo "<tr>";
				if (empty($row['Titre']))
					{
						echo "<td> pas d'album concerne </td>";
          }
          else 
          {
            echo "<td>" . $row['Titre']."</td>";
          }
					echo "<td><audio src=\"extrait.php?Code_Morceau=" . $row['Code_Morceau'] . "\" controls></td>";
					echo "<td> <form method=\"get\" action =\"panier.php\"> <input type=\"hidden\" name=\"Code_Morceau\" value=\" ". $row['Code_Morceau'] . "\"> <input type=\"hidden\" name=\"Code_Album\" value=\" ". $_GET['Code_Album'] . "\"><button type=\"submit\"> Se connnecter</button>
          </form> ". " </td>";
					echo "</tr>";
					}


			echo "</tbody>";
			echo "</table>";
			$pdo = null;
	?>
</div>
</body>
</html>
