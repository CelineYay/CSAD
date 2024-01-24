<?php
// Your database connection code (database.php)
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch categories from the database
$categoryQuery = mysqli_query($conn, "SELECT DISTINCT category FROM items");
$categories = [];
while ($row = mysqli_fetch_assoc($categoryQuery)) {
    $categories[] = $row['category'];
}

// Fetch suppliers from the database
$supplierQuery = mysqli_query($conn, "SELECT DISTINCT supplier FROM items");
$suppliers = [];
while ($row = mysqli_fetch_assoc($supplierQuery)) {
    $suppliers[] = $row['supplier'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $categoryFilter = isset($_POST['category_filter']) ? $_POST['category_filter'] : '';
    $supplierFilter = isset($_POST['supplier_filter']) ? $_POST['supplier_filter'] : '';

    $sql = "SELECT * FROM items WHERE 
            (name LIKE '%$search%' OR supplier LIKE '%$search%' OR category LIKE '%$search%') AND
            (category LIKE '%$categoryFilter%' OR '$categoryFilter' = '') AND
            (supplier LIKE '%$supplierFilter%' OR '$supplierFilter' = '')";

    $result = mysqli_query($conn, $sql);
} else {
    // Fetch all items initially
    $result = mysqli_query($conn, "SELECT * FROM items");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory</title>
</head>
<body>
<h1>Inventory</h1>

<form method="post" action="inventory.php">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">

    <label for="category_filter">Category:</label>
    <select name="category_filter" id="category_filter">
        <option value="">All</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category ?>"><?= $category ?></option>
        <?php endforeach; ?>
    </select>

    <label for="supplier_filter">Supplier:</label>
    <select name="supplier_filter" id="supplier_filter">
        <option value="">All</option>
        <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= $supplier ?>"><?= $supplier ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Filter</button>
</form>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Supplier</th>
        <th>Category</th>
        <th>Price</th>
        <th>Last Count</th>
        <th>Promotion Price</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['supplier'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['last_count'] ?></td>
            <td><?= $row['promotion_price'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>