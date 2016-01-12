
<!-- CONNEXION -->


	<div id="connexion">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<h3 class="text-center">Connexion Utilisateur</h3>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<form id="login-form" action="validation.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="UserName">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  <div class="form-group">
                    <input type="checkbox" name="remember" value="on"> Souvenez-vous! 
                  </div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Connecter">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Oubliez mot de passe?</a>
												</div>
											</div>
										</div>
									</div>
								</form>		

								<div class="text-center">
									<p>Vous n'avez pas un compte?</p>
									<a href="#" class="signup" data-toggle="modal" data-target="#myModalCon">S'INSCRIRE !</a>
								</div>
											


<!-- MODAL INSCRIRE -->								
								<div class="modal fade" id="myModalCon" role="dialog">
									<div class="modal-dialog" id="headModal">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" id="go" data-dismiss="modal">&times;</button>
												<p>Inscription utilisateur</p>
											</div>
<?php
  include 'php/checkdata.php';
?>
<!-- form connexion -->
											<div class="modal-body">
												<p><span class="error">* champ requis.</span></p>
												<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
													<label>Nom</label>
													<input type="text" name="nom" placeholder="Minion" class="formInput" value="<?php echo $nom;?>">
									   				<span class="error">* <p class="text-center"><?php echo $nomErr;?></p></span>
									   				<br><br>
									   				<label>Prénom</label>
									   				<input type="text" name="prenom" placeholder="Banana" class="formInput">
									   				<span class="error">* <p class="text-center"><?php echo $prenomErr;?></p></span>
									   				<br><br>
									   				<label>Login ID</label>
									   				<input type="text" name="logId" placeholder="Mini Bana" class="formInput">
									   				<span class="error">* <p class="text-center"><?php echo $logIdErr;?></p></span>
									   				<br><br>
									   				<label>Password</label>
									   				<input type="password" name="pass" class="formInput">
									   				<span class="error">* <p class="text-center"><?php echo $passErr;?></p></span>
									   				<br><br>
									   				<label>Email</label>
									   				<input type="text" name="email" placeholder="minabana@gmail.com" class="formInput">
									   				<span class="error">* <p class = "text-center"><?php echo $emailErr;?></p></span>
									 				<br><br>
									 				<label>Adresse</label>
									 				<input type="text" name="adresse" placeholder="Votre adresse" class="formInput">
									   				<br><br>
											
											</div>
											<div class="modal-footer">
												<div class="control-group">
												  <label class="control-label" for="singlebutton"></label>
												  <div class="controls">
												    <input type="submit" id="singlebutton" name="submit" class="btn btn-success" value="Valider">
												  </div>
												</div>
											</div>
										</form>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
<?php
	$driver = 'sqlsrv'; 
   $host = 'INFO-SIMPLET';
   $nomDb = 'Classique_Web';
   $user = 'ETD'; $password = 'ETD';
   $pdodsn = "$driver:Server=$host; Database=$nomDb";
   $pdo = new PDO($pdodsn, $user, $password);

   $lastname = $_POST['nom'];
   $firstname = $_POST['prenom'];
   $LoginID = $_POST['logId'];
   $Pass = $_POST['pass'];
   $Add = $_POST['adresse'];
   $Em = $_POST['email'];
   $query="iNSERT INTO Abonné (Nom_Abonné, Prénom_Abonné, Login, Password, Adresse, Email )
   VALUES ('".$lastname."','".$firstname."','".$LoginID."','".$Pass."','".$Add."','".$Em."')";

   if (($lastname!="" && $firstname !="" && $LoginID!= "" && $Pass !="") || $Em!= "")
    {$pdo->query($query);
      echo "<script type='text/javascript'>alert('Votre Inscription utilisateur a été créée! Connectez-vous, s il vous plait!')</script>";
    }
    $pdo = null;
?>