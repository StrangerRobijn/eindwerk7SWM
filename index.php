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



<?php

$product_ids = array();
//session_destroy();

//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>




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


<article>


        <nav class="cd-vertical-nav">
                <ul>
                    <li><a href="#section1" ><span class="label">Begin</span></a></li>
                    <li><a href="#section2"><span class="label">Video</span></a></li>
                    <li><a href="#section3"><span class="label">Het merk</span></a></li>
                    <li><a href="#section4"><span class="label">Kopen</span></a></li>
                </ul>
            </nav><!-- .cd-vertical-nav -->
            <button class="cd-nav-trigger cd-image-replace"><span aria-hidden="true"></span></button>

   <div id="section0">
  
    <img src="img/standaard_logo_crop.png"> 
   
    <?php  if (isset($_SESSION['username'])) : ?>

    	<p>Dag <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: grey; font-size:1.1em; ">Afmelden</a> </p>
       
    <?php endif ?>  
      
 
</div>

<div class="home">

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
            <div class="hideme">    
              <img src="img/leaf.png">
                <p>Blaster is de nieuwe norm op het gebied van natuurlijke smaken en aromas:
                alle belangrijke smaken komen van de vrucht zelf zonder bijgevoegde suikers of smaakstoffen.</p> <br>
                <br>
        </div>
        <div class="hideme">    
                <img src="img/energie.png">
               <p> Ook op het gebied van energie is Blaster de concurrentie al ver vooruit: met onze eigen aangepaste cafeïne hebben we geen suikers nodig om de gebruiker meer energie te geven.</p> 
            </div>
        </div>

            <div class="col-sm">
                <img class="gif" src="vid/resize.gif" alt="Blaster Aardbei">
            </div>

            <div class="col">
            <div class="hideme">    
                <img src="img/reuse.png">
                <p>De flesjes zijn ontworpen met millieuvriendelijkheid in het achterhoofd, dus 0% plastic in de flesjes, zo is Moeder Natuur tevreden !</p><br>
        </div>
                <br>
                <div class="hideme">    
                <img src="img/heart.png">
                <p>Blaster is ook heel gezond, het bevat geen schadelijke stoffen die uw  lichaam kunnen schaden, bovendien is Blaster alcohol vrij !</p>
        </div>
            </div>
          </div>
        </div>
        </div>



    <div id="section4">


        <div class="container">
        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'cart');
        $query = 'SELECT * FROM products ORDER by id ASC';

        $result = mysqli_query($connect, $query);

        if ($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                   ?>

                    <div class="container">
                        <form method="post" action="index.php?action=add&id=<?php echo $product ['id']; ?>">
                        <div class="products">
                            <img src="<?php echo $product['image']; ?>" class="img-responsive" />
                            <h4 class="text-info"><?php echo $product['name']; ?></h4>
                            <h4>$ <?php echo $product['price']; ?> </h4>
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product ['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product ['price']; ?>" />
                            <input type="submit" name="add_to_cart" class="btn btn-info" value="Kopen" />

                         </div>
                     </form>
                </div>

                   <?php
                   endwhile;
                endif;
            endif;

    ?>

         <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Uw producten</h3></th></tr>   
        <tr>  
             <th width="40%">Soort</th>  
             <th width="10%">Hoeveelheid</th>  
             <th width="20%">Prijs</th>  
             <th width="15%">Totaal</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  
        <tr>  
           <td><?php echo $product['name']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>$ <?php echo $product['price']; ?></td>  
           <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">$ <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <a href="#" class="button">Betalen</a>
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
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

