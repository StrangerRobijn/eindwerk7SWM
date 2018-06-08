<?php 
session_start(); 
include("db_conn.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');


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
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
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


    <div class="bg"></div>

    <div id="section4">

        <?php
        $connect =  mysqli_connect('localhost', 'dekeselr', 'jBsgC3M2', 'dekeselr');

        $query = 'SELECT * FROM products ORDER by id ASC';

        $result = mysqli_query($connect, $query);

        if ($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                   ?>

                    <div class="container">
                        <form method="post" action="products.php?action=add&id=<?php echo $product ['id']; ?>">
                        <div class="products">
                            <img src="<?php echo $product['image']; ?>" class="img-responsive" />
                            <h4 class="text"><?php echo $product['name']; ?></h4>
                            <h5>€ <?php echo $product['price']; ?> </h5>
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product ['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product ['price']; ?>" />
                            <input type="submit" name="add_to_cart" class="btn btn-secondary" value="Kopen" />

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
       
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  


         <div class="table-responsive">  
        <table class="table">  
        <tr>  
             <th width="40%">Soort</th>  
             <th width="20%">Hoeveelheid</th>  
             <th width="20%">Prijs</th>  
             <th width="15%">Totaal</th>  
             <th width="10%">Verwijder</th>  
        </tr>  

        <tr>  
           <td><?php echo $product['name']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>€ <?php echo $product['price']; ?></td>  
           <td>€ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="products.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn btn-danger">Verwijder</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
        
             <td align="right">Totaal bedrag</td>  
             <td align="right">€ <?php echo number_format($total, 2); ?></td>  
          
              
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="1">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
             
             <div id="section6">
             <a href="pay.php"><button class="btn btn-primary center-block"> Kopen</button></a>
                </div>
                

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

