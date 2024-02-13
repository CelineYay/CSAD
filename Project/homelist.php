<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body>

<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
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
            $productName = $row["productname"];
            $price = $row["price"];


            echo "<tr style='border: none'>";
            echo "<td><img style='width:100px; height:100px;' src='itemImages/" . $productName . "png" . "'></td>";
            echo "<td>" . $productName . "</td>";
            echo "<td>$" . $price . "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    </tbody>
</table>

</body>
</html>
