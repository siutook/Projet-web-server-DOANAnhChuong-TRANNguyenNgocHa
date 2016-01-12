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
  <br><br><br><br><br>
<?php

// Paramètres de connexion
$driver = 'sqlsrv';$host = 'INFO-SIMPLET';$nomDb = 'Classique_Web';
$user = 'ETD';$password = 'ETD';
// Chaîne de connexion
$pdodsn = "$driver:Server=$host;Database=$nomDb";
// Connexion PDO
$pdo = new PDO($pdodsn, $user, $password);
if(isset($_GET['page']))
  $page=$_GET['page'];
else $page=1;
$query="Select Distinct Instrument.Nom_Instrument, Instrument.Code_Instrument
FROM Album INNER JOIN (Disque INNER JOIN ((Enregistrement INNER JOIN (Instrument INNER JOIN Interpréter ON Instrument.Code_Instrument = Interpréter.Code_Instrument) ON Enregistrement.Code_Morceau = Interpréter.Code_Morceau) INNER JOIN Composition_Disque ON Enregistrement.Code_Morceau = Composition_Disque.Code_Morceau) ON Disque.Code_Disque = Composition_Disque.Code_Disque) ON Album.Code_Album = Disque.Code_Album
  ORDER BY Instrument.Nom_Instrument";

echo "<h1 align=center> Tous les instruments </h1>";
echo "</br></br>";
echo "</br></br>";
echo "<table border=1 align=center> <tr align=center> <td> <h2> Nom Instrument</h2> </td><td> 
<h2> Album </h2> </td> <td> <h2>Photo</h2> </td></tr>";
$nb = $page*10;                       
$i=0; $d=0;                           
foreach ($pdo->query($query) as $row) 
  $d+=1;                              
foreach ($pdo->query($query) as $row) 
{
  if ($i==$nb) break;
  if ($i>=$nb-10)
  { 
    $pdo1 = new PDO($pdodsn, $user, $password);
    $query1="Select Distinct Image FROM Instrument WHERE Code_Instrument=".$row['Code_Instrument'];
    if ($pdo1->query($query1)->fetchColumn() != null)
    {
      echo "<tr align=center><td><h4>". $row[utf8_decode('Nom_Instrument')]."</h4></td>
      <td><h4> <a href=Album.php?Code_Instrument=".$row['Code_Instrument'].
      "&Nom=".urlencode($row['Nom_Instrument']).">Tous les albums avec ".$row['Nom_Instrument']."</a></h4></td>
      <td><img src='image-instrument.php?Code_Instrument=".$row['Code_Instrument']."' alt='photo instrument' height=200></td></tr>";
    }
    else {
      $pdo1=null;
      echo "<tr align=center><td><h4>". $row[utf8_decode('Nom_Instrument')]."</h4></td>
      <td><h4> <a href=Album.php?Code_Instrument=".$row['Code_Instrument'].
      "&Nom=".urlencode($row['Nom_Instrument']).">Tous les albums avec ".$row['Nom_Instrument']."</a></h4></td>
      <td><h4>PAS IMAGE</h4></td></tr>";
    }
  }
  $i+=1;
} 
$pdo = null;
echo "</table></br></br></br>";
  /*--------------------------------------------------PAGINATION -------------------------------------------------*/
  if ($d<=50)                                                                                                               
  {
    if ($d>10)                                                      
    {
      echo "<center><ul class='pagination'>";                                                            
      if ($page>1)
        echo " <li><a href=Instrument.php?&page=".($page-1)."><</a></li>";
      for ($i=1; $i*10<$d+10 ; $i++) {
        if ($i==$page)                                                                                   
          echo " <li class='active'><a>".$i."</a></li>";                                                 
        else echo " <li><a href=Instrument.php?&page=".$i.">".$i."</a></li>";
      }
      if ($page*10<$d)
        echo " <li><a href=Instrument.php?&page=".($page+1).">></a></li>";
      echo "</ul></center>";
    }
  }
  else {
    echo "<center><ul class='pagination'>";
    if ($d%10==0)                 //  Compte
      $d=$d/10;                   //  le nombre
    else $d=(($d-($d%10))/10)+1;  //  de page                                                                           
    if ($page%5==0)                                                                                    
    {                                                                                                  
      $max=$page;                                                                                      
      $min=$max-4;                                                                                     
    }                                                                                                  
    else                                                                                               
    {                                                                                                  
      $min=$page-$page%5+1;                                                                            
      $max=$min+4;                                                                                     
    }                                                                                                  
    if ($page>5)                                                                                        
    {
        echo " <li><a href=Instrument.php?&page=".($page-5)."><<</a></li>";
        echo " <li><a href=Instrument.php?&page=".($page-1)."><</a></li>";
    }   
    else if ($page>1)
        echo " <li><a href=Instrument.php?&page=".($page-1)."><</a></li>";
    for ($i=$min; $i<=$max; $i++) 
    {                                                                    
      if ($i==$page)                                                                                   
        echo " <li class='active'><a>".$i."</a></li>";
      else echo "<li><a href=Instrument.php?&page=".$i.">".$i."</a></li>";                                   
      if ($i==$d) break;
    }     
    if ($page<$d)                                                                                   
    {             
        echo "<li><a href=Instrument.php?&page=".($page+1).">></a></li>";                                      
        if ($page+5<=$d)                                      
          echo "<li><a href=Instrument.php?&page=".($page+5).">>></a></li>";                                      
    }
    echo "</ul></center>";                                                                             
  }                                                                                                  
  /*--------------------------------------------------PAGINATION -------------------------------------------------*/  
echo "<center><a text-align=center href='#'> En haut de page </a></center></br></br>";
?>
</html>