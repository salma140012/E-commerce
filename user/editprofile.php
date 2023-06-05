<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">
  </head>

  <body>
  <?php include("../components/user_navbar.php"); ?>
	
	<?php 
	

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
	   
	   if(isset($_POST['submit'])){
		   $name_form = mysqli_real_escape_string($conn, $_POST['name']);
		   $pass_form = $_POST['password'];
		   $address_form = mysqli_real_escape_string($conn, $_POST['address']);
		   $phone_form = mysqli_real_escape_string($conn, $_POST['phone']);
		   $location_form = mysqli_real_escape_string($conn, $_POST['location']);
		   $profilePic_form = $_FILES["profilePic"]["name"];

			$update = "UPDATE user SET name='$name_form',address='$address_form',phone='$phone_form',location='$location_form' WHERE id = $user_id";
			mysqli_query($conn, $update);
			
			if($pass_form!=NULL){
				$pass_form = md5($pass_form);
				$update2 = "UPDATE user SET password='$pass_form' WHERE id = $user_id";
				mysqli_query($conn, $update2);
			}
			
			if($profilePic_form!=NULL){	
			   $target_dir = "../uploaded_img/";
			   $target_file = basename($_FILES["profilePic"]["name"]);
			   move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_dir.$target_file);
			   $update3 = "UPDATE user SET profilePic='$target_file' WHERE id = $user_id";
			   mysqli_query($conn, $update3);
			}
			
			header('location:profile.php');

		  };
	
	?>

    <div class="container">
      <div class="row mt-50">
        <div class="info">
          <img src="../uploaded_img/<?php echo $profilePic; ?>" alt="">
          <h1 class='mt-10'><?php echo ucfirst($name); ?></h1>
          <h5 class='mt-5'><?php echo ucfirst($user_type); ?></h5>
        </div>
        <div class="details">
		<form action="" method="post" id="saveProfile" class="input-group" enctype="multipart/form-data">
          <div class="item d-flex">
            <div class="title">
              Full Name:
            </div>
            <div class="boody">
              <input type="text" name="name" value='<?php echo $name; ?>'>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Email:
            </div>
            <div class="boody">
              <input type="text" name="FullName" placeholder='<?php echo $email; ?>' disabled>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Password:
            </div>
            <div class="boody">
              <input type="Password" name="password" placeholder='************'>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Address:
            </div>
            <div class="boody">
              <input type="text" name="address" value='<?php echo $address; ?>'>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Phone:
            </div>
            <div class="boody">
              <input type="text" name="phone" value='<?php echo $phone; ?>'>
            </div>
          </div>
          <hr>
          <div class="item d-flex">
            <div class="title">
              Location:
            </div>
            <div class="boody">
              <input type="text" name="location" value='<?php echo $location; ?>'>
            </div>
          </div>
          <hr>
		  <div class="item d-flex">
            <div class="title">
              Profile Pic:
            </div>
            <div class="boody">
              <input type="file" name="profilePic">
            </div>
          </div>
          <hr>
			<input type="submit" name="submit" value="Save" class="btn submit-btn">
			</form>
        </div>

      </div>


    </div>


  </body>

</html>