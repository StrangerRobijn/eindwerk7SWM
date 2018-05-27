<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Meld u eerst aan </title>
  <link rel="stylesheet" type="text/css" href="css/src/main.scss">
</head>
<body>

<div class="inlog">	 
  <form method="post" action="login.php">
		<?php include('errors.php'); ?>
		<h2>Login</h2>
  	<div class="input-group">
  		<label>Gebruikersnaam</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Wachtwoord</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
			<button type="submit" class="btn" name="login_user" id="input-submit">Login</button>
  	</div>
  	<p>
  		Nog geen account? <a href="register.php">Maak een account</a>
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