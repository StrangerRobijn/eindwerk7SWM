<?php 
session_start(); 
include("db_conn.php");


$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);


  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>



<?php
// validatie
if(isset($_POST['email'])){
  
    $_POST['email'] = htmlspecialchars($_POST['email']);

  
    $to = $_POST['email'];
    $subject = "Blaster nieuwsbrief";

    $message = "
    <html>
    <head>
    <title>GIP</title>
    </head>
    <body>
    <p>Beste,</p>
    <table>
    <tr>
    <th><h4> Danku voor u aan te melden voor de nieuwsbrief !</h4></th>
    </tr>
    <tr>
     <p> Uw email: ".$_POST["email"]." </p>
     <p> Uw gebruikersnaam: ".$_POST["username"]." </p>
    </tr>
    </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


    if(mail($to,$subject,$message,$headers)){
        echo "<p><strong>mail verstuurd</strong></p>";
      } else {
        echo "<p>Fout bij het versturen van e-mail</p>";
      }
  
}

?>



<?php

if (isset($_POST['username']) &&  isset($_POST['email']) ) {
            
            $_POST['username'] = mysqli_real_escape_string($db, $_POST['username']);
            $_POST['email'] = mysqli_real_escape_string($db, $_POST['email']);
  
          
        
    echo " ";
    
    $sql = "INSERT INTO gip_nieuwsbrief (username, email)
    VALUES ('{$_POST['username']}',  '{$_POST['email']}')";
        
    if ($result = mysqli_query($db, $sql)) {

        echo " ";

    } else {

   echo "<p>Query kan niet gelezen worden" . mysqli_error($db)."</p>";
    }       
} else {  
    echo "";       
}

?>


    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Blaster</title>
        <link rel="stylesheet" type="text/css" href="css/dist/reset.css">
        <link rel="stylesheet" href="css/dist/main.css">
        <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="img/manifest.json">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
<body>
<div class="menu">
<div id="header">
<div class="bg"></div>


<div class="inlog">	 
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


   <input type="text" name="username" id="username" placeholder="Gebruikersnaam*" required> <br>
   <br>

   
  <input type="text" name="email" id="email" placeholder="E-mail*" required> <br>
   <br>

  <input type="submit" value="Aanmelden voor nieuwsbrief">

</form>
<a href="products.php"><button class="btn btn-primary center-block">Homepagina</button></a>
</div>
</div>
</div>




</script>
  <script src="js/dist/main.min.js"></script>
          <script src="js/src/main.js"></script>
          <script src="js/dist/modernizr.js"></script> <!-- Modernizr -->
          <script src="js/dist/jquery-2.1.4.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

</body>
</html>

<?php
mysqli_close($db);
?>

