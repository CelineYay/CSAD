
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            let params = {
                username: document.getElementById("name").value,
                email: document.getElementById("email").value,
                receiptImagePath: '',

            };

            emailjs.send("service_4gfetyu", "template_zlwydtb", params)
                .then(function(response) {
                    console.log('Email sent:', response);
                    alert("Email sent!");
                })
                .catch(function(error) {
                    console.error('Error sending email:', error);
                    alert("Error sending email. Please try again later.");
                });
        }
    </script>
    <script type="text/javascript">
        (function(){
            emailjs.init("oaCtdKNtQKgsDfmyE");
        })();
    </script>


</head>
<body>

<?php

session_start();
$currentUsername = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
$currentEmail = ($currentUsername !== null) ? $currentUsername["email"] : null;
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$all = mysqli_query($conn, "SELECT * FROM payables");

// Fetch all rows from the result set and store them in an array
$items = mysqli_fetch_all($all, MYSQLI_ASSOC);



$query = "SELECT MAX(receiptNumber) AS max_receiptnumber FROM receipt";
$get = mysqli_query($conn, $query);

if ($get) {
    $row = mysqli_fetch_assoc($get);
    $receiptnumber = $row['max_receiptnumber'] + 1;
} else {
    // Handle the query error
    echo "Error: " . mysqli_error($conn);
}



?>
<div style="overflow: hidden;">
    <img src="crown.png" width="150" height="150" style="float: left;">
    <span style="text-align: right; display: block;">Invoice<br>#<?php echo"$receiptnumber"?></span>
</div>


<style>
    table {
        border-collapse: collapse;

    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    td.quantity {
        text-align:center;
    }

</style>
<table>

  <tr>
    <th>Items</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
  <tr>
  </tr>
  <?php
    $total=0;
    foreach($items as $item){
        echo"<tr>";
        echo"<td>{$item['itemname']}</td>";
        echo"<td>\${$item['price']}</td>";
        echo "<td class='quantity'>{$item['quantity']}</td>";
        echo "<td>\$" . number_format($item['price'] * $item['quantity'], 2) . "</td>";
        echo "</tr>";
        $finalitemcost= $item['price'] * $item['quantity'];

        $total += $item['price'] * $item['quantity'];
        mysqli_query($conn, "UPDATE payables SET finalitemprice = $finalitemcost WHERE itemname = '{$item['itemname']}'");

  }
  $tax=number_format($total/100*9,2);
  $final=$total+$tax;
  mysqli_query($conn, "INSERT INTO receipt (receiptNumber,cost, tax, finalPrice) VALUES ($receiptnumber,$total, $tax, $final)");

  // making a receipt message
  $image = imagecreatetruecolor(400, 200);
  $white = imagecolorallocate($image, 255, 255, 255);
  $black = imagecolorallocate($image, 0, 0, 0);


  imagettftext($image, 14, 0, 10, 30, $black, 'arial.ttf', "Items\tPrice\tQuantity\tTotal");
  $y = 50;
  foreach ($items as $item) {
      $text = "{$item['itemname']}\t\${$item['price']}\t{$item['quantity']}\t\$" . number_format($item['price'] * $item['quantity'], 2);
      imagettftext($image, 12, 0, 10, $y, $black, 'arial.ttf', $text);
      $y += 20;
  }
  $imagePath = 'path/to/receipt.png';
  imagepng($image, $imagePath);
  imagedestroy($image);

  // Include the image path in your response
  echo json_encode(['imagePath' => $imagePath]);

  ?>


</table>
<div>
    Visa:<span style="float: right; display: inline-block;">Subtotal: <?php echo number_format($total, 2);?></span><br>
    Card:<span style="float: right; display: inline-block;">Tax(9%): <?php echo"$$tax"?></span><br>
    Read:<span style="float: right; display: inline-block;">Total: <?php echo"$$final"?></span><br>
</div>
<p>
<p>
    Dear customer,<br>
    Thank you for choosing Crown Supermarket and deals, for<br>
    any refund please show this E-receipt with the product still<br>
    sealed within 7 days.Food items are non-refundable
</p>
<form>
    your name:<input type="text" id="name" placeholder="name" required value="<?php $currentUsername ?>"><br>
    your email:<input type="email" id="email" placeholder="email id" required value="<?php $currentEmail ?>"><br>

    <button type="submit" onclick="return sendEmail()">Send an email</button>
</form>
</body>
</html>



