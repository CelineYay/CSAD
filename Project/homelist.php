<?php
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center; /* Center the cards container */
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.2s; /* Animation for hover effect */
            background-color: #ffffff;
        }

        .card:hover {
            transform: scale(1.05); /* Slightly increase size on hover */
            box-shadow: 0 6px 12px rgba(0,0,0,0.25); /* Enhance shadow on hover */
        }

        .card img {
            width: 100%;
            height: 200px; /* Set a fixed height for images */
            object-fit: cover; /* Ensure images cover the area nicely */
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            margin: 0 0 10px 0;
            font-size: 20px;
            color: #333;
        }

        .card-price {
            margin: 0;
            font-size: 18px;
            color: #666;
            font-weight: bold;
        }
        .sale-label {
            color: #fff;
            background-color: #d9534f;
            padding: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="card-container">
    <?php
    $servername = "localhost";
    $username = "ty";
    $password = "123";
    $dbname = "csaduersdatabase";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the products table
    $sql = "SELECT productname, price FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $productName = htmlspecialchars($row["productname"], ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars($row["price"], ENT_QUOTES, 'UTF-8');

            echo "<div class='card'>";
            echo "<span class=\"sale-label\">Sale!</span>";
            echo "<img src='itemImages/" . $productName . ".png' alt='" . $productName . "'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $productName . "</h5>";
            echo "<p class='card-price'>$" . $price . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No products found.</p>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
