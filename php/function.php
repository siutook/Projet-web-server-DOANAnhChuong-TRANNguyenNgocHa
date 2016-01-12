<?php

	function album()
	{
		$driver = 'sqlsrv';$host = 'INFO-SIMPLET';$nomDb = 'Classique_Web';
		$user = 'ETD';$password = 'ETD';
		$pdodsn = "$driver:Server=$host;Database=$nomDb";
		// Connexion PDO
		$pdo = new PDO($pdodsn, $user, $password);
		$query = "Select Titre_Album,Année_Album from Album where Code_Album = 15 or Code_Album = 16 or Code_Album = 20";
		foreach ($pdo->query($query) as $key => $row) {
			# code...
			if($key == 0)
			{
				$GLOBALS['titre1'] = $row['Titre_Album'];
				$GLOBALS['an1'] = $row[utf8_decode('Année_Album')];
			}
			if ($key == 1)
			{
				$GLOBALS['titre2'] = $row['Titre_Album'];
				$GLOBALS['an2'] = $row[utf8_decode('Année_Album')];
			}
			if($key == 2)
			{
				$GLOBALS['an3'] = $row[utf8_decode('Année_Album')];
				$GLOBALS['titre3'] = $row['Titre_Album'];
			}
		}
	}
?>