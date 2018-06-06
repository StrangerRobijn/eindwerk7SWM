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
if(isset($_POST['number'])&&isset($_POST['email'])&&isset($_POST['adres'])){

    $_POST['number'] = htmlspecialchars($_POST['number']);
    $_POST['email'] = htmlspecialchars($_POST['email']);
    $_POST['adres'] = htmlspecialchars($_POST['adres']);


    $to = $_POST['email'];
    $subject = "Blaster bestelling";

    $message = "
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <p>Wij hebben je bestelling goed ontvangen!</p>
    <p>De drankjes komen zo snel mogelijk je kant op.</p>
    <p>Bedankt om voor Blaster te kiezen.</p>
    <p><strong>Het Blaster team</strong></p>
    <table>
    <tr>
    <th>E-mail</th>
    <th>Adres</th>
    </tr>
    <tr>
    <td>".$_POST["email"]."</td>
    <td>".$_POST["adres"]."</td>
    </tr>
    </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if(mail($to,$subject,$message,$headers)){
        echo "<p>Bericht verstuurd</p>";
      } else {
        echo "<p>Fout bij het versturen van e-mail</p>";
      }

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


<div class="wrapper">

<article>


   <div id="section0">
  
    <img src="img/standaard_logo_crop.png"> 
   
    <?php  if (isset($_SESSION['username'])) : ?>

        <p>Dag <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: grey; font-size:1.1em; ">Afmelden</a> </p>
        

       
    <?php endif ?>  
      
 
</div>


    <article>

  <div class="bg"></div>



<!-- Form-->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>Betaalkaart</h1>
    </div>
    <div class="form-content">
      <form>
        <div class="form-group">
        <input type="number" name="number" id="number" placeholder="Kaartnummer*" required> 
        </div>
        <div class="form-group">
        <input type="text" name="email" id="email" placeholder="E-mail*" required>
        </div>
        <div class="form-group">
        <input type="text" name="adres" id="adres" placeholder="Adres*" required>
        </div>
        <div class="form-group">
          <button type="submit">Kopen</button>
        </div>
      </form>
    </div>
  </div>
  <div class="form-panel two">
    <div class="form-header">
      <h1>PayPal</h1>
    </div>
    <div class="form-content">
      <form>
        <div class="form-group">
        <input type="text" name="email" id="email" placeholder="PayPal E-mail*" required>
        </div>
        <div class="form-group">
        <input type="text" name="adres" id="adres" placeholder="Adres*" required>
        </div>

        <div class="form-group">
          <button type="submit">Kopen</button>
        </div>
      </form>
    </div>
  </div>
</div>
</form
   
</article>

<div class="footer">
        <div id="button"></div>
      <div id="container">
      <div id="cont">
      <div class="footer_center">
           <h3>Blaster is een merk gecreëerd door Robin De Kesel 7SWM</h3>
           <img src="img/logo_footer.png">

      </div>
      </div>
      </div>
      </div>

</div>
          <script src="js/dist/main.min.js"></script>
          <script src="js/src/main.js"></script>
          <script src="js/dist/modernizr.js"></script> <!-- Modernizr -->
          <script src="js/dist/jquery-2.1.4.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

          
</body>
</html>

