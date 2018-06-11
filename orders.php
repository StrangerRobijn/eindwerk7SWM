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
        <html lang="en">
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
        <header>
            <div class="container-fluid row">
                <div class="container-fluid logo">
                    <img src="../images/logo.png" alt="Juicy 3 Logo">
                </div>
                <div class="col">
                    <div id="mySidenav" class="sidenav">
                        <a href="#" class="closebtn" id="btnCloseNav">&times;</a>
                        <div class="mobile-menu-items">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="products.php">Producten</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><img src="images/cart.png" class="cart" alt="Winkelmand voor knop Koop nu">
                                    <button type="button" class="btnUnderline"><a class="buy">Koop nu</a></button>
                                </li>
                              
                              
                            </ul>
                            <div class="socials">
                                <img src="#">
                                <img src="#">
                                <img src="#">
                            </div>
                        </div>
                    </div>
                    <span class="hamburger-icon" id="btnOpenNav">&#9776;</span>
                </div>
            </div>
        </header>
        <div class="container">
            <h2> Bestellingen</h2>
            <?php
                $query = "SELECT * FROM details";
                if (!empty($_SESSION['email'])) {
                    if (!$result = mysqli_query($db, $query)) {
                        echo "FOUT: Query kon niet uitgevoerd worden";
                        exit;
                    }

                    // stap 3: De resultaten naar het scherm schrijven
                    while ($rij = mysqli_fetch_array($result)) {
                        if (mysqli_num_rows($result) > 0) {
                            if ($_SESSION['email'] == $rij['email']) {
                                echo "<p>Products bought are : </p>";
                                        $sql = "SELECT * FROM producten WHERE product_id=".$rij['product'];
                                        if (!$result2 = mysqli_query($db,$sql)) {
                                            echo "FOUT: Query kon niet uitgevoerd worden";
                                            exit;
                                        }
                                        while ($row = mysqli_fetch_array($result2))
                                        {
                                            ?>
                                            <div class="container-fluid">
                                                <p class="col"><?php echo $row['naam'];?></p>
                                                <?php
                                                    echo "
                                                    <img class='col-3 img-fluid' src=\"images /{$row['foto']}\" alt=\"Fles van de smaak {$row['naam']}\" >
                                                     ";
                                                ?>
                                            </div>

                                            <?php
                                        } //afsluiten while

                                echo "
                                        <p>with an amount of : </p>".$rij['amount']."
                                        <form method='get'>
                                            <input type=\"hidden\" name=\"id\" value=\"{$rij['id']}\" >
                                            <button type=\"button\" class=\"btn btn-underline\"><a href=\"factuur.php?id={$rij['id']}\">Factuur</a></button>
                                        </form>
                                     ";
                            }
                        } else {
                            echo "<h2>test</h2>";
                            echo "<p>Koop gerust iets</p>";
                        }
                    }
                } else {
                    echo "</h2>U bent niet ingelogd!</h2>";
                }
                }
                    ?>
                </div>
                <script src="js/dist/main.min.js"></script>
          <script src="js/src/main.js"></script>
          <script src="js/dist/modernizr.js"></script> <!-- Modernizr -->
          <script src="js/dist/jquery-2.1.4.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

          
</body>
</html>
    

