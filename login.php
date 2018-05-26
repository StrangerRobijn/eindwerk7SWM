<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Meld u eerst aan </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Gebruikersnaam</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Wachtwoord</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Nog geen account? <a href="register.php">Maak een account</a>
  	</p>
  </form>
</body>
</html>