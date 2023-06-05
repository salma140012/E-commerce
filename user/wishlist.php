<?php

include '../components/user_navbar.php';


include '../user/wishlist_cart.php';

$user_id = $_SESSION['id'];

if(isset($_POST['delete'])){
    $wishlist_id = $_POST['wishlist_id'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$wishlist_id'") or die('query failed');
    header('location:../user/wishlist.php');
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/wishlist.css">

</head>
<body>
   
<section class="products">

   <h3 class="heading">your wishlist</h3>

   <div class="box-container">
   <?php
             if(isset($message)){
             foreach($message as $message){
             echo '<div class="message" onclick="this.delete();">'.$message.'</div>';
                   }
               }
            ?>
            <?php
            $wishlist_query = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            $grand_total = 0;
            if(mysqli_num_rows($wishlist_query) > 0){
            while($fetch_wishlist = mysqli_fetch_assoc($wishlist_query)){
                $grand_total += $fetch_wishlist['price'];
            ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
      <a href="../user/productPage.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
      <div class="name"><?= $fetch_wishlist['name']; ?></div>
      <div class="flex">
         <div class="price">EGP<?= $fetch_wishlist['price']; ?>.00</div>
         
         
      </div>
      
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      <input type="submit" value="delete item" onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">your wishlist is empty</p>';
   }
   ?>
   </div>

   <div class="wishlist-total">
      <p>grand total : <span>EGP<?= $grand_total; ?>.00</span></p>
      <br>
      <p>shipping: <span>EGP50.00</span></p>
      <a href="../user/homepage.php" class="option-btn">continue shopping</a>
      
   </div>

</section>


</body>
</html>