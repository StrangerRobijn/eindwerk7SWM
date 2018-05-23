<?php 
include("db_conn.php");


$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);

  session_start(); 

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

 <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>

<?php
// validatie
if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['subject'])){

    $_POST['name'] = htmlspecialchars($_POST['name']);
    $_POST['email'] = htmlspecialchars($_POST['email']);
    $_POST['subject'] = htmlspecialchars($_POST['subject']);


    $to = $_POST["email"];
    $subject = "contact via site";

    $message = "
    <html>
    <head>
    <title>Contact via site</title>
    </head>
    <body>
    <p>Wij hebben je aanvraag goed ontvangen!</p>
    <table>
    <tr>
    <th>Naam</th>
    <th>E-mail</th>
    <th>Bericht</th>
    </tr>
    <tr>
    <td>".$_POST["name"]."</td>
    <td>".$_POST["email"]."</td>
    <td>".$_POST["subject"]."</td>
    </tr>
    </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <robindekesel@gmail.com>' . "\r\n";
    $headers .= 'Cc: test@visocloud.org' . "\r\n";

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

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>

<div class="wrapper">

<div id="header">
<header>
    <img src="img/standaard_logo_crop.png">
</header>
</div>

<article>


        <nav class="cd-vertical-nav">
                <ul>
                    <li><a href="#header" ><span class="label">Intro</span></a></li>
                    <li><a href="#section2"><span class="label">Film</span></a></li>
                    <li><a href="#section3"><span class="label">Detail</span></a></li>
                    <li><a href="#section4"><span class="label">Kopen</span></a></li>
                </ul>
            </nav><!-- .cd-vertical-nav -->
            <button class="cd-nav-trigger cd-image-replace"><span aria-hidden="true"></span></button>

<div class="home">

<div id="section0">
        <a href="#section4"><button class="btn btn-secondary center-block"> Nu kopen</button></a>
</div>

  <div id="section1">
      <img src="img/trio2.png">
      <a href="#section4"><button class="btn btn-primary center-block"> Zie meer</button></a>
    
  </div>

  </div>

  <div id="section2">         
      <div class="embed-responsive embed-responsive-16by9">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/2btPQbrAxU8?showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
   </div>
  </div>

   <div id="section3">         
      <div class="container">
          <div class="row">

            <div class="col">
              <img src="img/leaf.png">
                <p>Blaster is de nieuwe norm op het gebied van natuurlijke smaken en aromas:
                alle belangrijke smaken komen van de vrucht zelf zonder bijgevoegde suikers of smaakstoffen.</p> <br>
                <br>
                <img src="img/energie.png">
               <p> Ook op het gebied van energie is Blaster de concurrentie al ver vooruit: met onze eigen aangepaste cafeïne hebben we geen suikers nodig om de gebruiker meer energie te geven.</p> 
            </div>

            <div class="col-sm">
                <img class="gif" src="vid/resize.gif" alt="Blaster Aardbei">
            </div>

            <div class="col">
                <img src="img/reuse.png">
                <p>De flesjes zijn ontworpen met millieuvriendelijkheid in het achterhoofd, dus 0% plastic in de flesjes, zo is Moeder Natuur tevreden !</p><br>
                <br>
                <img src="img/heart.png">
                <p>Blaster is ook heel gezond, het bevat geen schadelijke stoffen die uw  lichaam kunnen schaden, bovendien is Blaster alcohol vrij !</p>
            </div>
          </div>
        </div>

        <div id="section4">
            <div class="row">
             <div class="col">
                  <img src="img/aardbei_crop.png">
                </div>
             <div class="col">
                 <div class="color">                        
                    <p>De bestverkopende smaak in een nieuw jasje, koop snel de jouwe voordat ze allemaal zijn uitverkocht !</p> 
                    <ul>
                        <li>Goede bron aan <b>vitaminen</b>.</li>
                        <li>Alleen <b>de beste aardbeien</b> komen in onze productie terecht.</li>
                        <li>#1 <b>beste verkopende</b> bio energie drank op de markt.</li>
                        <li>Niet tevreden ? Geld terug !</li>
                    </ul>
                    <a href="#"><button class="btn btn-primary center-block"> In winkelmand steken</button></a>                
                </div>
                </div>
            </div>

            
            <div class="row">
                    <div class="col">
                         <img src="img/bosbes_crop.png">
                       </div>
                    <div class="col">
                        <div class="colorP">
                           <p> BLASTER bosbes <br>
                           De bestverkopende smaak in een nieuw jasje, koop snel de jouwe voordat ze allemaal zijn uitverkocht !</p> 
                           <ul>
                               <li>Goede bron aan <b>vitaminen</b>.</li>
                               <li>Alleen <b>de beste bosbessen</b> komen in onze productie terecht.</li>
                               <li>#1 <b>beste verkopende</b> bio energie drank op de markt.</li>
                               <li>Niet tevreden ? Geld terug !</li>
                           </ul>
                           <a href="#"><button class="btn btn-primary center-block"> In winkelmand steken</button></a>                
                       </div>
                       </div>
                   </div>
       

                   <div class="row">
                        <div class="col">
                             <img src="img/citroen_crop.png">
                           </div>
                        <div class="col">
                                <div class="colorY">
                                <p>BLASTER Citroen <br>
                                De zure maar verfrissende smaak in een nieuw jasje, koop snel de jouwe voordat ze allemaal zijn uitverkocht !</p>
                                <ul>
                                    <li>Goede bron aan <b>vitaminen</b>.</li>
                                    <li>Alleen <b>de beste citroenen</b> komen in onze productie terecht.</li>
                                    <li>#1 <b>beste verkopende</b> bio energie drank op de markt.</li>
                                    <li>Niet tevreden ? Geld terug !</li>
                                </ul>
                                <a href="#"><button class="btn btn-primary center-block"> In winkelmand steken</button></a>                
                            </div>
                           </div>
                       </div>
        </div>


         <div id="section5">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <h1>Form</h1>
                <form class="cf">
                  <div class="half left cf">
                    <input type="text" id="input-name" name="name" placeholder="Name" required>
                    <input type="email" id="input-email" name="email" placeholder="Email address" required>
                    <input type="text" id="input-subject" name="subject" placeholder="Subject" required>
                  </div>
                  <div class="half right cf">
                    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
                  </div>  
                  <input type="submit" value="Submit" id="input-submit">
                  <br><br>
                </form>

            </form>
        </div>


        <form method="post" action="send_script.php">
  Name: <input type="text" name="name" > <br />
  email: <input type="email" name="email" > <br />
  Subject: <input type="text" name="subject" > <br />
  Message: <textarea name="msg"></textarea>
  <button type="submit" name="send_message_btn">Send</button>
</form>

    </div>

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

