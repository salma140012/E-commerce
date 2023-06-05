<?php
include 'connect.php';

session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = '';
}

$user_id = $_SESSION['id'];
$select = " SELECT * FROM user WHERE id = '$user_id'";

$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_array($result);

    $profilePic = $row['profilePic'];

}
?>


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Homepage</title>
</head>

<nav>
    <div class="leftdflex">

        <a href="../market/homepage.php" alt="logo" class="logo">Market Place<span>.</span></a>
    </div>
   
    <div class="box">
        <div class="dflex">
            <ul class="submenu">

                <a href="../market/homepage.php">
                <li ><p style="font-size:16px">Products</p></li>
                </a>
                <a href="../market/brands.php">
                <li ><p style="font-size:16px">Brands</p></li>
                </a>
                <a href="../market/markets.php">
                <li ><p style="font-size:16px">Markets</p></li>
                </a>

            </ul>

        </div>
    </div>

    <div class="righ dflex">
        <?php
        $query1 = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id= '$user_id'");

        $wishlist_items = mysqli_num_rows($query1);

        $query2 = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id= '$user_id'");
        $cart_items = mysqli_num_rows($query2);

        ?>
        <div class="item">
            <form action="../market/search_page.php" method="POST">

                <a href="../market/search_page.php">
                    <i class="fa fa-search"></i>
                </a>
            </form>
        </div>
        <div class="item">
            <a href="../market/wishlist.php"><i class="fa fa-heart"><span>( <?php echo $wishlist_items; ?>
                        )</span></i></a>
        </div>
        <div class="item">
            <a href="../market/cartpage.php"><i class="fa fa-shopping-cart"><span>( <?php echo $cart_items; ?>
                        )</span></i></a>
        </div>
      


        <div class="item">

            <a href="../market/Market-Profile.php"><img src="../uploaded_img/<?php echo $profilePic; ?>" alt="logo"
                    class="logo"></a>
        </div>

        <div class="item">
            <a href="../components/logout.php">
                <button class="button" type="submit">
                    <h5>Sign out<h5>
                </button>
            </a>
        </div>





</nav>

<nav class="subnavigation">


</nav>