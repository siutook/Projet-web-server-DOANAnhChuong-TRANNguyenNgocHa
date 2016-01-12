<?php
 	$pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
 	$query = "select Extrait 
 			  FROM Album INNER JOIN (Disque INNER JOIN (Composition_Disque INNER JOIN Enregistrement ON Composition_Disque.Code_Morceau = Enregistrement.Code_Morceau) ON Disque.Code_Disque = Composition_Disque.Code_Disque) ON Album.Code_Album = Disque.Code_Album
              WHERE Enregistrement.Code_Morceau = " . $_GET['Code_Morceau'];
 	$stmt = $pdo->query($query);
 	//foreach ($pdo->query($query) as $row) {
 	//	echo "<p>" . $row['Photo'] ."</p>";
 	//}
 	$stmt->bindColumn(1, $lob, PDO::PARAM_LOB);
 	$stmt->fetch(PDO::FETCH_BOUND);
 	$audio = pack("H*", $lob);
 	header("Content-Type: audio/mpeg");
 	echo $audio;
 ?>