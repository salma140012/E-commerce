<?php
@include 'connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['cpassword']);
  $user_type = $_POST['user_type'];
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $location = mysqli_real_escape_string($conn, $_POST['location']);

  $balance = mysqli_real_escape_string($conn, $_POST['balance']);

  $profilePic = $_FILES['profilePic']['name'];
  $profilePic = filter_var($profilePic, FILTER_SANITIZE_STRING);
  $profilePic_size = $_FILES['profilePic']['size'];
  $profilePic_tmp_name = $_FILES['profilePic']['tmp_name'];
  $profilePic_folder = 'uploaded_img/' . $profilePic;
  //  $profilePic = $_POST['profilePic'];
  if ($profilePic == NULL) {
    $profilePic = "default.png";
  }

  $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {

    $error[] = 'user already exist!';

  } else {

    if ($pass != $cpass) {
      $error[] = 'password not matched!';
    } else {
      $insert = "INSERT INTO user(name, email, password, user_type , address ,phone ,location ,profilePic,balanceno) VALUES('$name','$email','$pass','$user_type' ,'$address','$phone' ,'$location' , '$profilePic','$balance')";
      $upload = mysqli_query($conn, $insert);

      if ($upload) {
        move_uploaded_file($profilePic_tmp_name, $profilePic_folder);
        $message[] = '';
      }
      header('location:login.php');

    }

  }
}
;


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/productPage.css" />
  <link rel="stylesheet" href="css/login-signup.css" />
  <title>Signup</title>
</head>

<body>
  <div class="background">
    <div class="form-box2">
      <h3>Create Account</h3>

      <form action="" <?php $_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data" id=signup
        class=input-group>
        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error_msg">' . $error . '</span>';
          }
          ;

        }
        ;

        ?>

        <input type="text" class="input-field" name="email" placeholder="email" required>
        <input type="text" class="input-field" name="name" placeholder="Username" required>
        <input type="text" class="input-field" name="password" placeholder="Enter Password" required>
        <input type="text" class="input-field" name="cpassword" placeholder="Confirm Password" required>
        <input type="text" class="input-field" name="address" placeholder="Adress" required>
        <input type="text" class="input-field" name="location" placeholder="location * optional"><br>
        <input type="text" class="input-field" name="phone" placeholder="Phone number">
        <div class="row">
          <label for="image">Upload image :</label>
          <input type="file" id="inputImage" name="profilePic" Name="photo" accept="pimage/*">
        </div>

        <label for="image">Select type :</label>
        <select name="user_type">
          <option value="user">user</option>
          <option value="market">market</option>
        </select><br>

        <input type="text" class="input-field" name="balance" placeholder="if Market profile, add balance number:"><br>


        <input type="submit" name="submit" value="signUp" class="submit-btn">


        <div class="ques2">
          already have an account ?... <a style="color: rgb(38, 101, 195);" href="login.php"> click here!</a>
        </div>





      </form>


    </div>

  </div>
  <script>
    var x = document.getElementById("demo");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    }
  </script>





</body>

</html>