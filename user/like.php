<?php include("../components/connect.php"); ?>

<?php 
	$user_id = $_POST['user_id'];
	$market_name = $_POST['market_name'];
	$insert = "INSERT INTO favmarkets(user_id,market_name) VALUES('$user_id','$market_name')";
    mysqli_query($conn, $insert);
?>