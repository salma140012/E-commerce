<?php include("../components/connect.php"); ?>

<?php 
	$user_id = $_POST['user_id'];
	$market_name = $_POST['market_name'];
	$delete = "delete from favmarkets where user_id='$user_id' and market_name='$market_name'";
    mysqli_query($conn, $delete);
?>