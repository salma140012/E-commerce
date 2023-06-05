<!DOCTYPE html>
<?php include("navbar.php"); ?>
<?php 

$sql = "SELECT * from `products` WHERE id=" . $_GET['id'];
$query = mysqli_query($conn, $sql);
while ($array = mysqli_fetch_array($query)) {
    $id = $array['id'];
    $name = $array['name'];
    $brand = $array['brand'];
    $price = $array['price'];
    $brief_description = $array['brief_description'];
    $full_description = $array['full_description'];
    $image_01 = $array['image_01'];
    $num_items = $array['num_items'];
    $market_name = $array['market_name'];
}




?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Shopping Site | High Quality Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/productPage.css" />
</head>

<body>


    <div class="flex-box">
        <div class="left2">
            <div class="big-img">
                <img src="pics/<?php echo $image_01; ?>">
            </div>

            <br>

        </div>

        <div class="right2">
            <form action=""  method="post">
                <br><br>
                <span class="product-seller"> brand <?php echo $name; ?></span><br>
                <span class="product-seller"> sold by <?php echo $market_name; ?></span>
                <div class="pname"><?php echo $name; ?></div><br>
                <span class="product-seller"> Model Number : CFI-1118A / PS5_Disc / CFI-1216A / CFI - 1116A/ CFI-1100A,
                    CFI-1200A, CFI-1000A / CFI-1218A</span>
                <div class="price">EGP <?php echo $price; ?>.00</div>

                <div class="quantity">

                    <p>Quantity :</p>
                    <input type="number" min="1" max="5" value="1">
                </div>

                <div class="btn-box1">
                    <button type="submit" name="addToCart" class="cart-btn">Add to cart</button>


                </div>
                <div class="btn-box2">
                    
                    <button type="submit" name="addToFavs" class="cart-btn"> <i class="fa fa-heart"></i>Add to
                        Favourites</button>

                </div>

            </form>

        </div>
        <?php
       
        
         if (array_key_exists('addToCart', $_POST)) {
           
                header("Location:login.php");
            }
         elseif (array_key_exists('addToFavs', $_POST)) {
            
                header("Location:login.php");
            
        }
        ?>
    </div>
    <div class="bottomDiv">

        <ul>
            <li>
                <?php echo $full_description; ?>
            </li>
        </ul>

    </div>




</body>

</html>