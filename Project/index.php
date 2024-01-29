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
} else {
    header("Location: hello.php");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link href="navigationdrawer.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="drawer">
    <a href="#" onclick="closeDrawer()">Close</a>
    <a href="#">Home</a>
    <a href="#">Query Item</a>
    <a href="#" onclick="toggleSubMenu('inventorySubMenu')">Inventory Item</a>
    <div id="inventorySubMenu" class="sub-menu">
        <a href="displayList.php">Update Inventory Items</a>
        <a href="search_inventory_form.php">Search Inventory Items</a>
    </div>
    <a href="#">Payment</a>
    <a href="#">Receipts</a>
    <a href="javascript:void(0);" onclick="confirmLogout()">Logout</a>
    <!-- Add more links as needed -->
</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openDrawer()">☰</span>
    <h1>Welcome <?php echo $row["username"]?></h1>
</div>

<script>
    function openDrawer() {
        document.getElementById("drawer").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeDrawer() {
        document.getElementById("drawer").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
    function toggleSubMenu(subMenuId) {
        var subMenu = document.getElementById(subMenuId);
        subMenu.style.display = (subMenu.style.display === "none") ? "block" : "none";
    }

    function confirmLogout() {
        var logoutConfirmed = confirm("Are you sure you want to logout?");
        if (logoutConfirmed) {
            // If user confirms, perform logout
            window.location.href = "logout.php";
        } else {
            // If user cancels, do nothing or provide alternative action
        }
    }
</script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

