<?php session_start();?>
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
    <h2>LES ORCHESTRES</h2>
    <p>Les orchestres magnifiques!</p>
<form id="f" method="get" action="orchestre.php">
  <input type="text" name="orchestre" placeholder="Recherche par titre d'orchestre"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button></input> 
</form>
<?php
      $driver = 'sqlsrv';$host = 'INFO-SIMPLET';$nomDb = 'Classique_Web';
      $user = 'ETD';$password = 'ETD';
      $pdodsn = "$driver:Server=$host;Database=$nomDb";
      // Connexion PDO
      $pdo = new PDO($pdodsn, $user, $password);
      if (!isset($_GET['orchestre']))
        $query = "select DISTINCT Orchestres.Nom_Orchestre, Orchestres.Code_Orchestre, Musicien.Nom_Musicien, Musicien.Prénom_Musicien
                  FROM Orchestres INNER JOIN 
                     (Direction INNER JOIN Musicien ON Direction.Code_Musicien = Musicien.Code_Musicien)
                     ON Orchestres.Code_Orchestre = Direction.Code_Orchestre
                  ORDER BY Orchestres.Nom_Orchestre";
      else
        $query = "select DISTINCT Orchestres.Nom_Orchestre, Orchestres.Code_Orchestre, Musicien.Nom_Musicien, Musicien.Prénom_Musicien
                  FROM Orchestres INNER JOIN 
                     (Direction INNER JOIN Musicien ON Direction.Code_Musicien = Musicien.Code_Musicien)
                     ON Orchestres.Code_Orchestre = Direction.Code_Orchestre
                  WHERE Orchestres.Nom_Orchestre LIKE '%" . $_GET['orchestre'] . "%'
                  ORDER BY Orchestres.Nom_Orchestre";

      echo 
      "<table class=\"table table-hover\">";
        echo"<thead><tr><th>TITRE ORCHESTRE</th><th>CHEF D'ORCHESTRE</th><th>ALBUM CONCERNENT</th></tr></thead>";
        echo "<tbody>";
        foreach ($pdo->query($query) as $row) {
          echo "<tr> <td>" . $row['Nom_Orchestre']."</td>";
          echo "<td>". $row['Nom_Musicien'] . " " . $row[utf8_decode('Prénom_Musicien')]."</td>";
          echo "<td><a href=\"orchestre-album.php?Nom_Orchestre=" . $row['Nom_Orchestre'] . "&Code_Orchestre=" . $row['Code_Orchestre'] . "\" > Liste des albums </a></td>";
          echo "</tr>";
        }
        echo "</tbody>";
      echo  "</table>";
      $pdo = null;  
?>
</div>
</body>
</html>