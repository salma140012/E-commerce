<?php   include("../components/user_navbar.php");
$user_id = $_SESSION['id'];?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchased Products</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/Purchased-Products.css">
</head>

<body>
  <div class="title mt-50">
          <h1>Purchased Products</h1>
        </div>

  <?php

//  $ip="ip";
  $order_query ="SELECT * FROM `order` WHERE `delivery_state`=1 AND `user_id`='$user_id'";
  $sql=mysqli_query($conn, $order_query); 
  $orders_result = mysqli_fetch_array($sql);


  foreach ($sql as $order):

    $timestamp = $order['time'];
    $pid = explode(",", ($order['pid']));
 

    foreach ($pid as $pp):
      
      $item_query = mysqli_query($conn, "SELECT * FROM products WHERE id=$pp");
      $item_query_r = mysqli_fetch_assoc($item_query);


        ?>
      <div class="container">
        

        <div class="prod mt-20 d-flex">
          <div class="img">
            <img src="../uploaded_img/<?php echo $item_query_r['image_01']; ?>" alt="">
          </div>

          <div class="prod-info">
            <h2><?php echo $item_query_r['name']; ?></h2>
          
            <p><h4 class="text"><?php echo $item_query_r['brief_description']; ?></h4></p>
   
            <div class="stock">Ordered On : <?php echo $timestamp; ?></div>
          </div>

          <div class="prod-price">
          EGP <?php echo $item_query_r['price']; ?>.00
          </div>
        </div>

      </div>

      <?php
    endforeach;
  endforeach;
  ?>
</body>

</html>