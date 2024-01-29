<!DOCTYPE html>
<?php
include'index.php';
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
if (isset($_POST["save"])) {
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

// Assuming you have a query to fetch product records
$productsQuery = "SELECT * FROM products";
$productsResult = $conn->query($productsQuery);
// Close the database connection
$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="./filter.js"></script>
</head>
<body>
<form action="#" method="post">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">
    <button onclick="searchProducts()">Search</button>

</form>
<!-- Display products records -->
<div class="outer-wrapper">
<div class="table-wrapper">
<table border="1" id="productstable">
    <thead>
        <th col-index = 1>ID</th>
        <th col-index = 2>Product Name</th>
        <th col-index = 3>Supplier
        <select class="table-filter" name="supplier" id="supplier" onchange="filter_rows()">
            <option value="all"></option>
        </select></th>
        <th col-index = 4>Category
        <select class="table-filter" onchange="filter_rows()" name="category" id="category">
            <option value="all"></option>
        </select></th>
        <th col-index = 5>Price</th>
        <th col-index = 6>Last Count</th>
        <th col-index = 7>Promotion Price</th>
    </thead>
    <?php
    while ($row = $productsResult->fetch_assoc()) {
        echo "<tbody>
            <tr>
            <td>{$row['id']}</td>
            <td>{$row['productname']}</td>
            <td>{$row['supplier']}</td>
            <td>{$row['category']}</td>
            <td>{$row['price']}</td>
            <td>{$row['lastcount']}</td>
            <td>{$row['promotionprice']}</td>
            
        
          </tr>
          </tbody>";
    }
    ?>
</table>
<script>
    window.onload = () => {
        console.log(document.querySelector("#productstable > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
    };

    getUniqueValuesFromColumn()
</script>
</div>
</div>



</body>
</html>
