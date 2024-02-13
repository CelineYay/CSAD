<?php
include 'index.php'; // Assuming index.php initializes the database connection
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

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

// Modify your products query based on the search term
if ($searchTerm) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE productname LIKE ?");
    $likeSearchTerm = "%$searchTerm%";
    $stmt->bind_param("s", $likeSearchTerm);
    $stmt->execute();
    $productsResult = $stmt->get_result();
} else {
    $productsResult = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    <script src="./filter.js"></script>
    <link rel="stylesheet" href="search.css">
    <style>
        body {
            margin-top: 50px; /* Adjust this value as needed */
        }
    </style>
</head>
<body>
<form action="#" method="post">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <button type="submit">Search</button>
</form>
<br>
<!-- Display product records -->
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
            <tbody>
            <?php while ($row = $productsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['productname']); ?></td>
                    <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['lastcount']); ?></td>
                    <td><?php echo htmlspecialchars($row['promotionprice']); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    window.onload = () => {
        console.log(document.querySelector("#productstable > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
    };
    getUniqueValuesFromColumn()
</script>
</body>
</html>
