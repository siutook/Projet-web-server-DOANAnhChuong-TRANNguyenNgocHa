<?php
 	$pdo = new PDO("sqlsrv:Server=INFO-SIMPLET;Database=Classique_Web", "ETD", "ETD");
 	$query = "select image FROM Instrument WHERE Code_Instrument=" . $_GET['Code_Instrument'];
 	$stmt = $pdo->query($query);
 	//foreach ($pdo->query($query) as $row) {
 	//	echo "<p>" . $row['Photo'] ."</p>";
 	//}
 	$stmt->bindColumn(1, $lob, PDO::PARAM_LOB);
 	$stmt->fetch(PDO::FETCH_BOUND);
 	$image = pack("H*", $lob);
 	
 	if ($image!= NULL){
 		header("Content-Type: image/jpeg");
 		echo $image;
 	}
 		//echo $image;
 	else 
 		echo "NOT IMAGE";
 ?>