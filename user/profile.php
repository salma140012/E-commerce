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
  <?php include("../components/user_navbar.php"); 
	

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
         <div class="sidebar">
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
        </div>

      </div>


    </div>


  </body>

</html>