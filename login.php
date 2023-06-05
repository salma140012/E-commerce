<?php

@include 'connect.php';

session_start();

if(isset($_SESSION['id'])){
   $user_id = $_SESSION['id'];
}else{
   $user_id = '';
};
if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
      $_SESSION['id'] = $row['id'];

      if($row['user_type'] == 'market'){

         $_SESSION['market_name'] = $row['name'];
         header('location:market/homepage.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user/homepage.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/login-signup.css" />
  <title>Login</title>
</head>


<body>
  <div class="background">
    <div class="form-box1">
      <h3>Sign in</h3>

      <form action="" method="post" class="input-group">


      <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>



        <input type="email" class="input-field" name="email"placeholder="Username" required>
        <input type="password"class="input-field" name="password"placeholder="Enter Password" required><br><br><br>
        <input type="submit" name="submit" value="login" class="submit-btn">
        

      </form>
      <br><br>
      <div class="s-btn">
     
        <a href="signup.php">
          <button type="submit" class="submit-btn">
            SignUp
          </button>
        </a>
       
      


    </div>

  </div>





</body>

</html>