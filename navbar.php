<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = '';
}

?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Homepage</title>
</head>

<nav>
    <div class="leftdflex">

        <a href="homepage.php" alt="logo" class="logo">Market Place<span>.</span></a>
    </div>

    <div class="box">
        <div class="dflex">
            <ul class="submenu">

                <a href="homepage.php">
                <li ><p style="font-size:16px">Products</p></li>
                </a>
                <a href="brands.php">
                <li ><p style="font-size:16px">Brands</p></li>
                </a>
                <a href="markets.php">
                <li ><p style="font-size:16px">Markets</p></li>
                </a>

            </ul>

        </div>
    </div>

    <div class="righ dflex">

    <div class="item">
            <form action="search_page.php" method="POST">

                <a href="search_page.php">
                    <i class="fa fa-search"></i>
                </a>
            </form>
        </div>
        <div class="item">
            <a href="login.php"><i class="fa fa-heart"><span>( 0 )</span></i></a>
        </div>
        <div class="item">
            <a href="login.php"><i class="fa fa-shopping-cart"><span>( 0 )</span></i></a>
        </div>
       


        <div class="item">

            <a href="login.php"><img src="uploaded_img/default.png" alt="logo" class="logo"></a>
        </div>

        <div class="item">
            <a href="login.php">
                <button class="button" type="submit">
                    <h5>Login<h5>
                </button>
            </a>
        </div>





</nav>

<nav class="subnavigation">


</nav>