<?php
	session_start();
	if(!isset($_COOKIE["NOM_USER"]))
	{
		if(isset($_SESSION["NOM_USER"]))
			$nom = $_SESSION["NOM_USER"];
	}
	else $nom = $_COOKIE["NOM_USER"];
?>

<!DOCTYPE html>
<html>
<head>
	<title> Albums Classiques </title>
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

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

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
					<li><a href="#myCarousel">ACCUEIL</a></li>
					<li><a href="#about">À PROPOS</a></li>
					<li><a href="#tousAlbums">TOUS ALBUMS</a></li>
					<?php
					if(empty($_SESSION["NOM_USER"]) && empty($_COOKIE["NOM_USER"]))
					{
						echo "<li><a href='#connexion'>S'INSCRIRE</a></li>";
						echo "<li><a href='#connexion'>CONNEXION</a></li>";
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
<!-- END NAVBAR -->

<!-- CAROUSEL -->


	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>

		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<a href="album.php"><img src="image/album.jpg" alt="ALBUM"></a>
				<div class="carousel-caption">
					<h3>ALBUM</h3>
					<p>Tous les albums listés par ordre alphabétique en un seul clic !</p>
				</div>
			</div>

			<div class="item">
				<a href="compositeur.php"><img src="image/compositeur.png" alt="COMPOSITEUR"></a>
				<div class="carousel-caption">
					<h3>COMPOSITEURS</h3>
					<p>Tous les compositeurs porté de main !</p>
				</div>
			</div>

			<div class="item">
				<a href="orchestre.php"><img src="image/orchestre.jpg" alt="ORCHESTRES"></a>
				<div class="carousel-caption">
					<h3>ORCHESTRES</h3>
					<p>Tous les orchestres en cliquant ici !</p>
				</div>
			</div>

			<div class="item">
				<a href="instrument.php"><img src="image/interprete.jpg" alt="INTERPRETES"></a>
				<div class="carousel-caption">
					<h3>INTERPRETES</h3>
					<p>Tous les interprètes en cliquant ici !</p>
				</div>
			</div>

			

		</div>

		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			 <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			 <span class="sr-only">Next</span>
		</a>

	</div>
<!-- END CAROUSEL -->


<!-- CONTAINER APROPOS-->


	<div id="about" class = "container text-center">
		<h3> À PROPOS </h3>
		<p> Nous aimons la musique classique! </p>
		<p> Nous avons créé un site web afin de partager notre passion. </p>
		<br>
		<div class = "row">
			<div class="col-md-6">
				<p style="font-size: 25px"><strong>Anh Chương</strong></p><br>
				<a href="#demo" data-toggle="collapse">
					<img src="image/chuong.jpg" class="img-circle pers" alt="image de Chuong">
				</a>
				<div id="demo" class="collapse">
					<p> Étudiant à l'IUT Informatique de Bordeaux </p>
					<p><span class="glyphicon glyphicon-map-marker"></span>Ho Chi Minh Ville, Vietnam</p>
    			  	<p><span class="glyphicon glyphicon-phone"></span>Téléphone: +00 1515151515</p>
      				<p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p> 
				</div>
			</div>
			<div class="col-md-6">
				<p style="font-size: 25px"><strong>Ngọc Hà</strong></p><br>
				<a href="#demo2" data-toggle="collapse">
					<img src="image/ha.jpg" class="img-circle pers" alt="image de Ha">
				</a>
				<div id="demo2" class="collapse">
					<p> Étudiant à l'IUT Informatique de Bordeaux </p> 
					<p><span class="glyphicon glyphicon-map-marker"></span>Ho Chi Minh Ville, Vietnam</p>
    			  	<p><span class="glyphicon glyphicon-phone"></span>Téléphone: +00 1515151515</p>
      				<p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p> 
				</div>
			</div>
		</div>

		<h3 class="text-center" style="padding: 50px">NOS TRAVAUX</h3> 
		<ul class="nav nav-tabs">
  			<li class="active"><a data-toggle="tab" href="#home">Chương</a></li>
  			<li><a data-toggle="tab" href="#menu1">Hà</a></li>
  			<li><a data-toggle="tab" href="#menu2">Peter</a></li>
		</ul>

		<div class="tab-content">
  			<div id="home" class="tab-pane fade in active">
    			<h2>Mike Ross, Manager</h2>
    			<p>Man, we've been on the road for some time now. Looking forward to lorem ipsum.</p>
  			</div>
  			<div id="menu1" class="tab-pane fade">
    			<h2>Chandler Bing, Guitarist</h2>
    			<p>Always a pleasure people! Hope you enjoyed it as much as I did. Could I BE.. any more pleased?</p>
  			</div>
  			<div id="menu2" class="tab-pane fade">
    			<h2>Peter Griffin, Bass player</h2>
    			<p>I mean, sometimes I enjoy the show, but other times I enjoy other things.</p>
  			</div>
		</div>

	</div>
<!-- END A PROPOS -->
<?php
	include 'php/function.php';
	$titre1 = $titre2 = $titre3 ="";
	$an1 = $an2 = $an3 = 0;
	album();
?>
<!-- TOUS ALBUMS -->
<div id="tousAlbums" class="bg-1">
		<div class="container1">
			<h3 class="text-center">ALBUMS</h3>
			<p class="text-center">Quelques albums vous pouvez aimer.<br> N'hésitez pas de les acheter! </p>
			<br>
			<div class="row text-center">
				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="image-album.php?Code_Album=15" alt="album1" width="400" height="300">
						<p><strong><?php echo $titre1; ?></strong></p>
						<p><?php echo $an1; ?></p>
						<button class="btn" data-toggle="modal" data-target="#myModal">Lire</button>

						<!-- Modal -->

						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog" id="headModal">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h3><?php echo $titre1?></h3>
										<p><?php echo $an1?></p>
									</div>

									<div class="modal-body">
										
									</div>

									<div class="modal-footer">
										<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Fermer</button>
										<a class="up-arrow" href="#headModal" data-toggle="tooltip" title="HAUT DE PAGE">
											<span class="glyphicon glyphicon-chevron-up"></span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<!-- end Modal -->

					</div>
				</div>

				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="image-album.php?Code_Album=16" alt="album2" width="400" height="300">
						<p><strong><?php echo $titre2; ?></strong></p>
						<p><?php echo $an2; ?></p>
						<button class="btn" data-toggle="modal" data-target="#myModal">Lire</button>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="thumbnail">
						<img src="image-album.php?Code_Album=20" alt="album3" width="400" height="300">
						<p><strong><?php echo $titre3; ?></strong></p>
						<p><?php echo $an3; ?></p>
						<button class="btn" data-toggle="modal" data-target="#myModal">Lire</button>
					</div>
				</div>

				<button class="btn"><a href="album.php">En savoir plus</a></button>
			</div>
		</div>
	</div>
<?php 
	if(empty($_SESSION["NOM_USER"]) && empty($_COOKIE["NOM_USER"]))
		include 'signup.php';?>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Faite par groupe CHUA</p> 
</footer>

</body>
</html>