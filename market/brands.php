<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/brands-markets.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Brands</title>
</head>

<body>
    <?php include("../components/market_navbar.php"); ?>

    <?php

    $sql = "SELECT DISTINCT brand FROM products";

    $r = mysqli_query($conn, $sql);

    $brand = [];

    while ($array = mysqli_fetch_array($r)) {
        $brand[] = $array['brand'];
    }

    ?>
    <section class="brand-list">
        <div class="brand-container">

            <?php
            foreach ($brand as $a_brand):

                $sql2 = "SELECT * FROM `products` WHERE `brand`='$a_brand'";
                $r2 = mysqli_query($conn, $sql2);
                while ($array = mysqli_fetch_array($r2)) {
                    $brand_name = $array['brand'];
                }

                ?>
                <div class="cell2">
                    <div class="heart">

                        <a href='brandProducts.php?brandName=<?php echo $brand_name; ?>'>
                            <button style="margin-right:330px;" type="button" class="cart-btn"> <i style="color:#610000;"
                                    class="fa fa-eye"></i> See all products</button>
                        </a>
                    </div>
                    <div class="name">
                        <?php
                        echo $a_brand;
                        ?>

                    </div>

                </div>



                <?php endforeach; ?>

        </div>
    </section>
</body>

</html>