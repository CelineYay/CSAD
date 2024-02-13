<?php
include 'index.php'
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 70px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            width: 350px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 16px rgba(0,0,0,0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            margin: 0;
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        .card-price {
            margin: 15px 0 0;
            font-size: 18px;
            color: #666;
        }

        .sale-label {
            position: absolute;
            top: 20px;
            left: -10px;
            color: #fff;
            background-color: #d9534f;
            padding: 5px 10px;
            border-radius: 0 5px 5px 0;
            font-size: 14px;
        }

        /* Additional styling for modern look */
        @media (max-width: 768px) {
            .card-container {
                justify-content: center;
            }
            .card {
                width: 90%;
            }
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
            echo '<span class="sale-label">Sale!</span>';
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
