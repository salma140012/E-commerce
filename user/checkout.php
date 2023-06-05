<?php

@include '../components/user_navbar.php';
$user_id = $_SESSION['id'];
if (isset($_POST['order_btn'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_id`='$user_id'");
   $price_total = 0;

   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $pQ[] = $product_item['quantity'];
         $pid[] = $product_item['pid'];
         $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += ((int) $product_price) + 50;
      }
   }

   $total_product = implode(',', $product_name);
   $total_ids = implode(',', $pid);
   $p_quantities = implode(',', $pQ);
   $product_id_counter = count($pid);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(user_id,pid,pquantity,name, number, email, method, flat, street, city,  country, pin_code, total_products, total_price) 
   VALUES('$user_id','$total_ids','$p_quantities','$name','$number','$email','$method','$flat','$street','$city','$country','$pin_code','$total_product','$price_total')") or die('query failed');


   $balance = 0;

   for ($i = 0; $i < $product_id_counter; $i++) {

      $product_queryy = "SELECT * FROM products WHERE id='$pid[$i]'";
      $sql1 = mysqli_query($conn, $product_queryy);

      $res = mysqli_fetch_assoc($sql1);
      $qtty = $res['num_items'];

      $market_id = $res['marketid']; //returns market id that's associated witht the current product

      $product_price = $res['price'];

      // $qtty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity FROM cart WHERE pid = '$pid[$i]'"))['quantity'];
      $update = "UPDATE products SET num_items =$qtty-$pQ[$i] WHERE id = '$pid[$i]'";
      $update_query = mysqli_query($conn, $update);

      $cart_remove_query = "DELETE FROM cart WHERE user_id='$user_id' AND pid='$pid[$i]'";
      $sql2 = mysqli_query($conn, $cart_remove_query);

      $product_market_query = "SELECT * FROM user WHERE id='$market_id'";
      $sql3 = mysqli_query($conn, $product_market_query);

      $balance = mysqli_fetch_assoc($sql3)['balance'];
      // $qtty_int = intval($qtty);
      $update_market_balance = "UPDATE user SET balance=$balance+($pQ[$i]*$product_price) WHERE id='$market_id'";

      $sql4 = mysqli_query($conn, $update_market_balance);



   }
   if ($cart_query && $detail_query) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>" . $name . "</span> </p>
            <p> your number : <span>" . $number . "</span> </p>
            <p> your email : <span>" . $email . "</span> </p>
            <p> your address : <span>" . $flat . ", " . $street . ", " . $city . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> your payment mode : <span>" . $method . "</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='homepage.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/checkout.css">

</head>

<body>


   <div class="container">

      <section class="checkout-form">

         <h1 class="heading">complete your order</h1>

         <form action="" method="post">

            <div class="display-order">
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `user_id`='$user_id'");
               $total = 0;
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                     $grand_total = ((int) $total += (int) $total_price) + 50;
                     ?>
                     <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                     <?php
                  }
               } else {
                  echo "<div class='display-order'><span>your cart is empty!</span></div>";
               }
               ?>
               <span class="grand-total"> grand total : EGP<?= $grand_total; ?>.00 </span>
            </div>

            <div class="flex">
               <div class="inputBox">
                  <span>your name</span>
                  <input type="text" placeholder="enter your name" name="name" required>
               </div>
               <div class="inputBox">
                  <span>your number</span>
                  <input type="number" placeholder="enter your number" name="number" required>
               </div>
               <div class="inputBox">
                  <span>your email</span>
                  <input type="email" placeholder="enter your email" name="email" required>
               </div>
               <div class="inputBox">
                  <span>payment method</span>
                  <select name="method">
                     <option value="cash on delivery" selected>cash on devlivery</option>
                     <option value="credit cart">credit cart</option>
                     <option value="paypal">paypal</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>address line 1</span>
                  <input type="text" placeholder="e.g. flat no." name="flat" required>
               </div>
               <div class="inputBox">
                  <span>address line 2</span>
                  <input type="text" placeholder="e.g. street name" name="street" required>
               </div>
               <div class="inputBox">
                  <span>city</span>
                  <input type="text" placeholder="e.g. Cairo" name="city" required>
               </div>
               <div class="inputBox">
                  <span>country</span>
                  <input type="text" placeholder="e.g. Egypt" name="country" required>
               </div>
               <div class="inputBox">
                  <span>pin code</span>
                  <input type="text" placeholder="e.g. 123456" name="pin_code" required>
               </div>
            </div>
            <input type="submit" value="order now" name="order_btn" class="btn">
         </form>

      </section>

   </div>

</body>

</html>