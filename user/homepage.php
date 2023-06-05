<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Homepage</title>
</head>

<body>
    <?php include("../components/user_navbar.php"); ?>
    <?php

    $sql = "SELECT * FROM products";

    $r = mysqli_query($conn, $sql);

    $id = [];
    $name = [];
    $brand = [];
    $price = [];
    $brief_description = [];
    $full_description = [];
    $image_01 = [];
    $num_items = [];
    $market_id = [];



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

        // $market_name[] = $array['market_name'];
    }





    ?>
    <section class="product-list">
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
                    <a name="productDetails" href="productPage.php?id=<?php echo $id[$i]; ?>">
                        <li>View details</li>

                    </a>
                    <div class="product-image-wrapper">
                        <img src="../uploaded_img/<?php echo $image_01[$i]; ?>" class="product-image">
                    </div>
                    <div class="product-info-container">
                        <h3 class="product-name">
                            <?php echo $name[$i]; ?>
                        </h3>
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


    </section>




</body>

</html>