<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
  </head>

  <body>
  <?php include("../components/market_navbar.php"); 
	

		$user_id = $_SESSION['id'];
		$select = " SELECT * FROM user WHERE id = '$user_id'";

	   $result = mysqli_query($conn, $select);

	   if(mysqli_num_rows($result) > 0){

		  $row = mysqli_fetch_array($result);
		  
		  $name = $row['name'];
		  $email = $row['email'];
		  $user_type = $row['user_type'];
		  $address = $row['address'];
		  $phone = $row['phone'];
		  $location = $row['location'];
		  $profilePic = $row['profilePic'];
		  $balance = $row['balance'];
		  $balanceno = $row['balanceno'];
	   }
	
	?>
  
<div class="bigCont">
    <div class="sidebar2">
          <a href="wishlist.php">Favorite-product</a>
          <a href="liked-markets.php">Liked markets</a>
          <a href="Purchased Products.php">Purchased Products</a>
          <a href="in-process-products.php">in process products </a>
          </div>
    <div class="container">

      <div class="row mt-50">
        <div class="info">
          <img src="../uploaded_img/<?php echo $profilePic; ?>" alt="">
          <h1 class='mt-10'><?php echo ucfirst($name); ?></h1>
          <h5 class='mt-5'><?php echo ucfirst($user_type); ?></h5>
        </div>
        <div class="details">
          <div class="item d-flex">
            <div class="title">
              Full Name:
            </div>
            <div class="boody">
              <?php echo $name; ?>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Email:
            </div>
            <div class="boody">
              <?php echo $email; ?>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Password:
            </div>
            <div class="boody">
              *****************
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Address:
            </div>
            <div class="boody">
              <?php echo $address; ?>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Phone:
            </div>
            <div class="boody">
              <?php echo $phone; ?>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Location:
            </div>
            <div class="boody">
              <?php echo $location; ?>
            </div>
          </div>
          <hr>

          <button class='btn'>
            <a href="editprofile.php">Edit The Above</a>
          </button>
          <button class='btn'>
            <a href="AddProduct.php">Add Product</a>
          </button>
        </div>

      </div>

      </div>
    </div>
  
<?php 
    $user_id = $_SESSION['id'];
    
    $sql = "SELECT * from `products` WHERE marketid='$user_id'";

    $r = mysqli_query($conn, $sql);
    $name = [];
$id = [];
    while ($array = mysqli_fetch_array($r)) {
        $id[] = $array['id'];
        $name[] = $array['name'];
        $brand[] = $array['brand'];
        $price[] = $array['price'];
        $brief_description[] = $array['brief_description'];
        $full_description[] = $array['full_description'];
        $image_01[] = $array['image_01'];
        $num_items[] = $array['num_items'];
        $market_id[] = $array['marketid'];
    }

    ?>     
    <div class="product-list">
        <!--  Product cell image, name, brand, market, price, brief description, availability -->

        <div class="product-grid-container">

            <!-- name, brand, price, brief_description, full_description, image_01, num_items, market_name -->
            <?php
            for ($i = 0; $i < count($name); $i++):
                $sql2 = "SELECT * FROM `user` WHERE `id`='$market_id[$i]'";
                $r2 = mysqli_query($conn, $sql2);



                while ($array = mysqli_fetch_array($r2)) {
                    $market_name = $array['name'];
                }
                ?>
            <div class="cell">
                <a name="productDetails"  href="productPage.php?id=<?php echo $id[$i]; ?>">
                    <li>View details</li>

                </a>
                <div class="product-image-wrapper">
                    <img src="../uploaded_img/<?php echo $image_01[$i]; ?>" class="product-image">
                </div>
                <div class="product-info-container">
                    <h3 class="product-name"> <?php echo $name[$i]; ?> </h3>
                    <h3 class="product-price"> EGP <?php echo $price[$i]; ?>.00</h3>

                    <div class="availability">
                        <?php
                if ($num_items[$i] > 0) {
                    echo "Available";
                } else {
                    echo "Sold Out";
                }

                        ?>
                    </div>
                    <div class="text">
                        <?php echo $brief_description[$i]; ?>
                    </div>
                    <span class="product-seller">brand :<?php echo $brand[$i]; ?></span>
                    <span class="product-seller"> sold by <?php echo $market_name; ?></span>

                </div>
            </div>

            <?php endfor; 
              
            ?>


              </div>






  </body>

</html>