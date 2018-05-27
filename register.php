<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Een account maken </title>
  <link rel="stylesheet" type="text/css" href="css/src/main.scss">
	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

</head>
<body>
  
<div class="inlog">
  <form method="post" action="register.php">
		<?php include('errors.php'); ?>
		<h2>Registreer</h2>
  	<div class="input-group">
  	  <label>Gebruikersnaam</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Wachtwoord</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Bevestig wachtwoord</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registreren</button>
  	</div>
  	<p>
  		Al een account? <a href="login.php">Aanmelden</a>
		</p>
	</form>
</div>
	<div class="bg"></div>

	<script src="js/dist/main.min.js"></script>
          <script src="js/src/main.js"></script>
          <script src="js/dist/modernizr.js"></script> <!-- Modernizr -->
          <script src="js/dist/jquery-2.1.4.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</body>
</html>