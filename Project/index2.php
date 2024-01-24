<!DOCTYPE html>
<?php
session_start();
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
}else{
    header("Location: hello.php");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Welcome <?php echo $row["username"]?></h1>
<a href="logout.php">Logout</a>
<form action="#" method="post">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">

    <label for="category">Category:</label>
    <select name="category" id="category">
        <option value="">All</option>
        <option value="Category1">Category 1</option>
        <option value="Category2">Category 2</option>
        <!-- Add more categories as needed -->
    </select>

    <label for="supplier">Supplier:</label>
    <select name="supplier" id="supplier">
        <option value="">All</option>
        <option value="Supplier1">Supplier 1</option>
        <option value="Supplier2">Supplier 2</option>
        <!-- Add more suppliers as needed -->
    </select>

    <button type="submit">Filter</button>
</form>

</body>
</html>
