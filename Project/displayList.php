<!DOCTYPE html>
<?php

include 'index2.php';

// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
if (isset($_POST["save"])){
    $productname = $_POST['productname'];
    $supplier = $_POST['supplier'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $lastcount = $_POST['lastcount'];
    $promotionprice = $_POST['promotionprice'];

    $query = "INSERT INTO products (productname,supplier,category,price,lastcount,promotionprice) VALUES ('$productname', '$supplier', '$category','$price','$lastcount', '$promotionprice')";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Save Successful');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    div {
        margin-bottom: 10px;
    }
</style>
<body>
<div class="wrapper">
<form method="POST" action="displayList.php">
    <div class="input-box">
    <label for="productname">Product Name:</label><br>
    <input type="text" name="productname" id="productname" placeholder="" required value=""/>
    </div>
    <div class="input-box">
    <label for="supplier">Supplier:</label><br>
    <input type="text" name="supplier" id="supplier" placeholder="" required value=""/>
    </div>
    <div class="input-box">
    <label for="category">Category:</label><br>
    <input type="text" name="category" id="category" placeholder="" required value=""/>
    </div>
    <div class="input-box">
    <label for="price">Price:</label><br>
    <input type="text" name="price" id="price" placeholder="" required value=""/>
    </div>
    <div class="input-box">
    <label for="lastcount">Last Count:</label><br>
    <input type="text" name="lastcount" id="lastcount" placeholder="" required value=""/>
    </div>
    <div class="input-box">
    <label for="promotionprice">Promotion Price:</label><br>
    <input type="text" name="promotionprice" id="promotionprice" placeholder="" required value=""/>
    </div>
    <div>
        <button type="save" name="save">Save</button>
    </div>
</form>
</div>




</body>
</html>
