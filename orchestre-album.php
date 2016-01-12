<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title> Tous les albums orchestres </title>
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
      </div>
    </div>
  </nav>

  <div class="container">
    <h2>LES ALBUMS D'ORCHESTRE</h2>
    <p>Les albums d'orchestres que vous avez cherchez!</p>
  <?php
    echo "<center><h2>Album de l'orchestre" . " " . $_GET['Nom_Orchestre'] .  "</h2></center>";
    ?>
<?php
      $driver = 'sqlsrv';$host = 'INFO-SIMPLET';$nomDb = 'Classique_Web';
      $user = 'ETD';$password = 'ETD';
      $pdodsn = "$driver:Server=$host;Database=$nomDb";
      // Connexion PDO
      $pdo = new PDO($pdodsn, $user, $password);
       $query = " select DISTINCT Album.Titre_Album, Album.Année_Album, Album.Code_Album
                FROM Album INNER JOIN
                       (Disque inner join 
                       (Composition_Disque INNER JOIN 
                       (Enregistrement INNER JOIN 
                       (Direction INNER JOIN Orchestres ON Direction.Code_Orchestre = Orchestres.Code_Orchestre)
                      ON Enregistrement.Code_Morceau = Direction.Code_Morceau)
                      ON Composition_Disque.Code_Morceau = Enregistrement.Code_Morceau)
                      ON Disque.Code_Disque = Composition_Disque.Code_Disque)
                      ON Album.Code_Album = Disque.Code_Album
                WHERE Orchestres.Code_Orchestre = " . $_GET['Code_Orchestre'];
      echo 
      "<table class=\"table table-hover\">";
        echo"<thead><tr><th>TITRE ALBUM</th><th>ANNEE</th><th>IMAGE</th></tr></thead>";
        echo "<tbody>";
        foreach ($pdo->query($query) as $row) {
          echo "<tr>";
          if (empty($row['Titre_Album']))
          {
            echo "<td> pas d'album concerne </td>";
          }
          else 
          {
            echo "<td> <a href=\"disque-album.php?Code_Album=" . $row['Code_Album'] . "\" >" . $row['Titre_Album']."</td>";
            //echo "<td>" . $row['Titre_Album']."</td>";
          }
          if (empty($row[utf8_decode('Année_Album')]))
          {
            echo "<td> pas d'album concerne </td>";
          }
          else 
          {
            echo "<td>".$row[utf8_decode('Année_Album')]."</td>";
          }
          echo "<td><img src=\"image-album.php?Code_Album=" . $row['Code_Album'] . "\" height=\"100\"></td>";
          echo "</tr>";
          

        }
        echo "</tbody>";
      echo 
      "</table>";
      $pdo = null;
      ?>
</div>
</body>
</html>