<?php

include '../components/market_navbar.php';
$user_id = $_SESSION['id'];
$sub_total = 0;

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['name'];
   $product_price = $_POST['price'];
   $product_image = $_POST['image'];
   $product_quantity = $_POST['quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:cartpage.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Shopping Site | High Quality Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    
    <link rel="stylesheet" href="../css/cartpage.css" />
</head>


<body>
   
 
    <div class="small-container cart-page">
    
    
        <table>
            <thead>
                <div class="header1">
                <th style="text-align: justify;"> Product </th>
                </div>

                <div class="header2">
                <th> Quantity </th>
                </div>

                <div class="header3">
                <th> Subtotal </th>
                </div>
            </thead>
           

            <tr>
            <?php
             if(isset($message)){
             foreach($message as $message){
             echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                   }
               }
            ?>
            <?php
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
            ?>
                <td>
                
                    <div class="cart-info">
                        
                           <img src="../uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt="">
                            <div class="infoo">
                                <p><?php echo $fetch_cart['name']; ?></p>
                                <small>EGP<?php echo $fetch_cart['price']; ?>.00</small>
                                <br>
                                <a href="cartpage.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');"><i class="fa fa-trash-o"></i><b> Remove</b></a>
                                
                            </div>
    
                    </div>
                </td>
                <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" class="quan" id ="c1" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="btnUpdate" id = "c2">
                  
               </form>
               </td>
                
                <td id = "c3">EGP<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>.00</td>
            </tr>
            <?php
                $grand_total += $sub_total+50;
                  }
               }else{
                     echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
                    }
        ?>
            
        </table>
        <div class="total-price">
       
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Cart total</th>
                    </tr>
                </thead>
                
                <tr>
                <td>Subtotal</td>
                <td>EGP<?php echo $grand_total-50; ?>.00</td>
                </tr>
                <tr>
                <td>Shipping</td>
                <td>EGP50.00</td>
                </tr>
                <tr>
                <td>Total</td>
                <td>EGP<?php echo $grand_total; ?>.00</td>
                </tr>
                
                <tr> <td colspan="2"><a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a></td></tr>
                <tr> <td colspan="2"><a href="homepage.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Continue Shopping</a></td></tr>
            </table>
            
        </div>
  
    </div>

    

</body>
</html>