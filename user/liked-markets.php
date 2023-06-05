<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/brands-markets.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Liked markets</title>
</head>

<body>
    <?php include '../components/user_navbar.php';
    if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
        header('location:../user/liked-markets.php');
     }
     ?>
    

    
    <?php
    $user_id = $_SESSION['id'];
    $sql = "SELECT DISTINCT market_name FROM favmarkets WHERE user_id = '$user_id'";

    $r = mysqli_query($conn, $sql);

    $market_name = [];

    while ($array = mysqli_fetch_array($r)) {
        $market_name[] = $array['market_name'];
    }

    ?>
    <section class="brand-list">
        <form action="" method="post">
            <div class="brand-container">

                <?php
				$count=0;
                foreach ($market_name as $a_market):
                    ?>
                    <div class="cell2" id="div<?php echo $count; ?>">
                        <div class="heart">
                        <a onclick="removeFromFavs('<?php echo $a_market; ?>', '<?php echo $count; ?>')" class="delete-btn" onclick="return confirm('remove market from favs? ?');"><i style="color:#610000;" class="fa fa-trash-o"></i><b> Remove</b></a>
                        </div>
                        <div class="name">

                            <?php
                            echo $a_market;

                            ?>


                        </div>



                    </div>
                    <?php $count++; endforeach;
                ?>
            </div>
        </form>

    </section>
	
<script src="../js/jquery-3.6.3.min.js"></script>
<script>
	function removeFromFavs(market_name, count){
		$.ajax({
			url : 'unlike.php',
			type: 'POST',
			data: {market_name:market_name, user_id:<?php echo $_SESSION['id']; ?>}
		}).done(function(response){
			$('#div'+count).hide();
		});
	}
</script>

</body>
</html>