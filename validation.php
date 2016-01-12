<?php
	if ($_POST['username'] == "" || $_POST['password'] = "")
	{
		echo "<script type='text/javascript'>alert('Login ID ou Mot de passe sont vides!')</script>";
		echo "<script>setTimeout(\"location.href='index.php#connexion';\",100);</script>";
	}
	else 
	{
		$Password = $_REQUEST["password"];
		$Login = $_REQUEST["username"];
		$Remember = $_REQUEST['remember'];
		$driver = 'sqlsrv'; $host = 'INFO-SIMPLET';
		$nomDb = 'Classique_Web';
		$user = 'ETD'; $passwordBD = 'ETD';
		$req_txt = "select Login, Password, Nom_Abonné from Abonné where Login='".$Login."' and Password='".$Password."'";
		$strConnection = "$driver:Server=$host;Database=$nomDb";


		try {
			$arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
			$pdo = new PDO($strConnection, $user, $passwordBD,$arrExtraParam);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			die($msg);
		}

		$req = $pdo->query($req_txt);
		$CONNECTE = false;
		while ($row = $req->fetch()) {
			$CONNECTE=true;
			$Nom_User=$row[utf8_decode('Nom_Abonné')];
		}
		$req->closeCursor();
		$pdo=NULL;

		if($CONNECTE == true) {
			session_start();
			if($Remember == "on")
			{
				setcookie("NOM_USER",$Nom_User,time() + 3600*24*7);
				$_COOKIE["NOM_USER"] = $Nom_User;
			}
			else 
				{
					
					$_SESSION["NOM_USER"] = $Nom_User;
				}

			header("Location: index.php");
		} else {
			echo "<script type='text/javascript'>alert('Incorecte mot de passe ou login ID!')</script>";
			echo "<script>setTimeout(\"location.href='index.php#connexion';\",100);</script>";
		}
	}
?>