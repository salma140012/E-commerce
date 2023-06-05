<?php
//include 'components/user_navbar.php';
$user_id = $_SESSION['id'];
if (isset($_POST['add_to_wishlist'])) {

   if ($user_id == '') {
      header('location:login.php');
   } else {

      $pid = $_POST['id'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name ='$name' AND user_id = '$user_id'");
      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$name' AND user_id = '$user_id'");

      if (mysqli_num_rows($check_wishlist_numbers) > 0) {
         $message[] = 'already added to wishlist!';
      } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
         $message[] = 'already added to cart!';
      } else {
         $insert_wishlist = mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id',' $pid', '$name', '$price', '$image')");
         $message[] = 'added to wishlist!';
      }

   }

}

if (isset($_POST['add_to_cart'])) {

   if ($user_id == '') {
      header('location:login.php');
   } else {

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      //$quantity = $_POST['quantity'];
      //$quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'");


      if (mysqli_num_rows($check_cart_numbers) > 0) {
         $message[] = 'already added to cart!';
      } else {

         $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name ='$name' AND user_id = '$user_id'");

         if (mysqli_num_rows($check_wishlist_numbers) > 0) {
            $delete_wishlist = mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$name' AND user_id ='$user_id'");
         }

         mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, image,quantity) VALUES('$user_id', '$pid', '$name', '$price','$image','1')");
         $message[] = 'added to cart!';

      }

   }

}

?>