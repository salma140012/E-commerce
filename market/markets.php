<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/brands-markets.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Markets</title>
</head>

<body>
    <?php include '../components/market_navbar.php'; ?>
    <?php

    $sql = "SELECT * FROM `user` WHERE `user_type`='market'";
    $r = mysqli_query($conn, $sql);

    $market_name = [];
    $market_id = [];


    while ($array = mysqli_fetch_array($r)) {
        $market_name[] = $array['name'];


    }

    ?>
    <section class="brand-list">
        <form action="" method="post">
            <div class="brand-container">

                <?php
                foreach ($market_name as $a_market):

                            $sql2 = "SELECT * FROM `user` WHERE `name`='$a_market'";
                            $r2 = mysqli_query($conn, $sql2);
                            while ($array = mysqli_fetch_array($r2)) {
                                $market_id = $array['id'];
                            }
                           
                    ?>
                    <div class="cell2">
                        <div class="heart">
                            <button style="margin-right:400px;" type="button"
                                onclick="addToFavs('<?php echo $a_market; ?>', this)" class="cart-btn"> <i
                                    style="color:#610000;" class="fa fa-heart"></i> Like</button>

                            <a href='marketProducts.php?marketId=<?php echo $market_id; ?>'>
                                <button style="margin-right:330px;" type="button" class="cart-btn"> <i
                                        style="color:#610000;" class="fa fa-eye"></i> See all products</button>
                            </a>
                        </div>
                        <div class="name">

                            <?php

                            echo $a_market;
                            $user_id = $_SESSION['id'];

                            ?>

                        </div>

                    </div>
                    <?php endforeach;



                ?>
            </div>
        </form>

    </section>


    <?php foreach ($market_name as $a_market) {
    if (array_key_exists('addToFavs' . $a_market, $_POST)) {
        $insert = "INSERT INTO favmarkets(user_id,market_name) VALUES('$user_id','$a_market')";
        $upload = mysqli_query($conn, $insert);
    }
}
?>


    <script src="../js/jquery-3.6.3.min.js"></script>
    <script>
        function addToFavs(market_name, elem) {
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: { market_name: market_name, user_id:<?php echo $_SESSION['id']; ?>}
        }).done(function (response) {
                    $(elem).hide();
                });
    }

    </script>

</body>

</html>