
<?php

include("../components/market_navbar.php"); 
$user_id = $_SESSION['id'];
$market_name = $_SESSION['market_name'];
if(!isset($_SESSION['market_name'])){
    header('location:../login.php');
 };

 if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $name=filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price=filter_var($price, FILTER_SANITIZE_STRING);

    $brand = $_POST['brand'];
    $brand=filter_var($brand, FILTER_SANITIZE_STRING);

    $brief_description = $_POST['brief_description'];
    $brief_description=filter_var( $brief_description, FILTER_SANITIZE_STRING);

    $full_description = $_POST['full_description'];
    $full_description=filter_var( $full_description, FILTER_SANITIZE_STRING);

    $num_items = $_POST['num_items'];
    $num_items=filter_var( $num_items, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var( $image_01, FILTER_SANITIZE_STRING);
    $image_01_size=$_FILES['image_01']['size'];
    $image_01_tmp_name=$_FILES['image_01']['tmp_name'];
    $image_01_folder='../uploaded_img/'.$image_01;
 
    if(empty($name) || empty($price) || empty($image_01) || empty($brand) || empty($brief_description) || empty($full_description) || empty($num_items)){
        $message[] = 'please fill out all';
     }else{
        $insert = "INSERT INTO products(marketid,name, price, brand ,brief_description ,full_description ,num_items,image_01,market_name ) VALUES('$user_id','$name', '$price', '$brand',
         '$brief_description', '$full_description', '$num_items' , '$image_01','$market_name')";
        $upload = mysqli_query($conn, $insert);
        if($upload){
           move_uploaded_file($image_01_tmp_name, $image_01_folder);
           $message[] = 'new product added successfully';
        }else{
           $message[] = 'could not add the product';
        }
     }
  
  };
 
 
 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/addProduct.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <title>Add Product</title>
</head>

<body>


    <form action="" <?php $_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data">
        <div class="jc-center">
            <div class="card">
                <div class="roww">
                    <label for="pimage"><b>Product Image:</b></label><br>
                    <input type="file" name="image_01" accept="pimage/*" required>
                </div>

                <div class="roww">
                    <label for="pname"><b>Product Name :</b></label>
                    <input type="text" name="name" placeholder="product name" required>
                </div>
                <div class="roww">
                    <label for="pbrand"><b>Product Brand:</b></label>
                    <input type="text" name="brand" placeholder="product brand" required>
                </div>
                <div class="roww">
                    <label for="pprice"><b>Product Price :</b></label>
                    <input type="number" name="price" min="0" max="9999999999" placeholder="product price" onkeypress="if(this.value.length==10)return false;" required>
                </div>
                <div class="roww">
                    <input type="textarea" name="brief_description" placeholder="Enter  Brief description here..."
                    maxlength="500"  required>
                </div>
                <div class="roww">
                    <input type="textarea" name="full_description" placeholder="Enter  Full description here..."
                       cols="30" rows="10" maxlength="500" required>
                </div>
                <div class="roww7">
                    <label for="pquantity"><b>No.of items available: </b></label>
                    <input name="num_items" type="number" id="pquantity" placeholder="1" required>
                </div>
                <br><br>
            
                <input type="submit" class="button" name="add_product" value="add product">
                       

                    
                </a>
            </div>
        </div>


    </form>


</body>
<html>