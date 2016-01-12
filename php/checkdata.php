<!-- check info -->
<?php
	$nomErr = $emailErr = $prenomErr = $logIdErr = $passErr = "";
	$nom = $email = $prenom = $logId = $pass = $adresse = "";
	// define variables and set to empty values

  $driver = 'sqlsrv'; 
  $host = 'INFO-SIMPLET';
  $nomDb = 'Classique_Web';
  $user = 'ETD'; $password = 'ETD';
  $pdodsn = "$driver:Server=$host; Database=$nomDb";
  $pdo = new PDO($pdodsn, $user, $password);

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {		
    if (empty($_POST["nom"]))
   {
     $nomErr = "Nom est obligé!";
   } 
   else 
   {	
      $nom = test_input($_POST["nom"]);
      $query_check = "select Nom_Abonné from Abonné where Nom_Abonné='" . $_POST['nom'] . "'";
      if ($pdo->query($query_check)->fetchColumn()!= "" && $nom !="") 
      {
        $nomErr ="Nom a été existé! Un autre nom, s'il vous plait!";
      }
      else
      {
     			// check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {
          $nomErr = "Only letters and white space allowed"; 
        }
      }
    }

  if (empty($_POST["email"])) {
    $emailErr = "Email est obligé!";
  } else
  {
    $email = test_input($_POST["email"]);
     		// check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["logId"])) {
    $logIdErr = "Login ID est obligé!";
  } else {
    $logId = test_input($_POST["logId"]);
    $query_check = "select Login from Abonné where Login='" . $_POST['logId'] . "'";
    if ($pdo->query($query_check)->fetchColumn()!= "" && $logId !="") 
    {
      $logIdErr ="Login a été existé! Un autre Login ID, s'il vous plait!";
    } else {
     		// check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$logId)) {
        $logIdErr = "Only letters and white space allowed"; 
      }
    }
  }

  if (empty($_POST["prenom"])) {
    $prenomErr = "Prénom est obligé!";
  } else {
    $prenom = test_input($_POST["prenom"]);
    $query_check = "select Prénom_Abonné from Abonné where Prénom_Abonné='" . $_POST['prenom'] . "'";
    if ($pdo->query($query_check)->fetchColumn()!= "" && $prenom != "") 
    {
      $prenomErr ="Prénom a été existé! Un autre prénom, s'il vous plait!";
    } else
    {
     		// check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$prenom)) {
        $prenomErr = "Only letters and white space allowed! "; 
      }
    }
  }

  if (empty($_POST["pass"])) {
    $passErr = "Password est obligé!";
  } else {
    $pass = $_POST["pass"];
  }

  if (!empty($_POST["adresse"])) {
    $adresse = test_input($_POST["adresse"]);
  }
}

  if ($nomErr != "" || $prenomErr != "" || $logIdErr != "" || $passErr != "") {
    echo "<script type='text/javascript'>";
    echo "$('body').addClass('modal-open');";
    echo "$('#myModalCon').show();";
    echo "$('#myModalCon').addClass('in');";
    echo "$('#go').on('click', function() { $('#myModalCon').removeClass('in'); $('body').removeClass('modal-open'); $('#myModalCon').hide();});";
    echo "</script>";
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $pdo = null;
?>