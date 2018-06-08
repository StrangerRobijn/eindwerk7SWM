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

if (isset($_POST['numbers']) &&  isset($_POST['email'])  &&  isset($_POST['adres'])  &&  isset($_POST['tele']) ) {
            
            $_POST['numbers'] = mysqli_real_escape_string($db, $_POST['numbers']);
            $_POST['email'] = mysqli_real_escape_string($db, $_POST['email']);
            $_POST['adres'] = mysqli_real_escape_string($db, $_POST['adres']);
            $_POST['tele'] = mysqli_real_escape_string($db, $_POST['tele']);

  
          
        
    echo " ";
    
    $sql = "INSERT INTO details (numbers, email, adres, tele)
    VALUES ('{$_POST['numbers']}',  '{$_POST['email']}' , '{$_POST['adres']}' , '{$_POST['tele']}')";
        
    if ($result = mysqli_query($db, $sql)) {

        echo " ";

    } else {

   echo "<p>Query kan niet gelezen worden" . mysqli_error($db)."</p>";
    }       
} else {  
    echo "";       
}

?>

  <?php
  
// validatie
if(isset($_POST['numbers'])&&isset($_POST['email'])&&isset($_POST['adres'])){

    $_POST['numbers'] = htmlspecialchars($_POST['numbers']);
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


    <article>

  <div class="bg"></div>




<!-- Form-->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>Bankcontact</h1>
    </div>
    <div class="form-content">
      <form>
        <div class="form-group">
        <input type="number" name="numbers" id="numbers" placeholder="Kaartnummer*" required> 
        </div>
        <div class="form-group">
        <input type="text" name="email" id="email" placeholder="E-mail*" required>
        </div>
        <div class="form-group">
        <input type="text" name="adres" id="adres" placeholder="Adres*" required>
        </div>
        <div class="form-group">
        <input type="number" name="tele" id="tele" placeholder="Telefoonnummer*" required> 
        </div>

        <div class="form-group">
          <button type="submit">Kopen</button>
          <?php  if(mail($to,$subject,$message,$headers)){
        echo "<p>Er is een bevestigingsmail gestuurd naar ".$_POST["email"]." </p>";
      }?>
          
      <br>
        </div>
      </form>
    </div>
  </div>




  <div class="form-panel two">
    <div class="form-header">
      <h5>Het is niet mogelijk om met Paypal te betalen wegens onderhoudswerken</h5>
      <h1>PayPal</h1>
    </div>
    <div class="form-content">
      <form>
      <div class="form-group">
        <input type="text" name="email" id="email" placeholder="E-mail*" required>
        </div>
        <div class="form-group">
        <input type="text" name="adres" id="adres" placeholder="Adres*" required>
        </div>

       <div class="form-group">
          <button type="submit">Kopen</button>
          <?php  if(mail($to,$subject,$message,$headers)){
        echo "<p><strong>Er is een bevestigingsmail gestuurd naar ".$_POST["email"]." </strong> </p>";
      }?>
          
      <br>
      </div>
      </form>
    </div>
  </div>
</form>






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
          <script src="js/dist/jquery-2.1.4.js"></script>
          <script src="js/dist/main.min.js"></script>


<!-- Dit wou niet werken in de main.js -->
<script>

$(document).ready(function() {
    var panelOne = $('.form-panel.two').height(),
      panelTwo = $('.form-panel.two')[0].scrollHeight;
  
    $('.form-panel.two').not('.form-panel.two.active').on('click', function(e) {
      e.preventDefault();
  
      $('.form-toggle').addClass('visible');
      $('.form-panel.one').addClass('hidden');
      $('.form-panel.two').addClass('active');
   
    });
  
    $('.form-toggle').on('click', function(e) {
      e.preventDefault();
      $(this).removeClass('visible');
      $('.form-panel.one').removeClass('hidden');
      $('.form-panel.two').removeClass('active');
    
    });
  });

  </script>

          
</body>
</html>

