<?php
 	$pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
 	$query = "select Pochette FROM Album WHERE Code_Album=" . $_GET['Code_Album'];
 	$stmt = $pdo->query($query);
 	//foreach ($pdo->query($query) as $row) {
 	//	echo "<p>" . $row['Photo'] ."</p>";
 	//}
 	$stmt->bindColumn(1, $lob, PDO::PARAM_LOB);
 	$stmt->fetch(PDO::FETCH_BOUND);
 	$image = pack("H*", $lob);
 	header("Content-Type: image/jpeg");
 	echo $image;
 ?>