<?php
include 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            let username = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let table=document.getElementById("table").outerHTML;
            let summary=document.getElementById("summary").outerHTML;

            // Check if both username and email are set
            if (username && email) {
                let params = {
                    username: username,
                    email: email,
                    table: table,
                    summary:summary
                };

                console.log('Sending email with params:', params);

                emailjs.send("service_4gfetyu", "template_zlwydtb", params)
                    .then(function(response) {
                        console.log('Email sent:', response);
                        alert("Email sent!");
                    })
                    .catch(function(error) {
                        console.error('Error sending email:', error);
                        alert("Error sending email. Please try again later.");
                    });
            } else {
                // If either username or email is not set, display an error message
                alert("Please enter both username and email before sending the email.");
            }
        }
    </script>


    <script type="text/javascript">
        (function(){
            emailjs.init("oaCtdKNtQKgsDfmyE");
        })();
    </script>


</head>

<body>
<div class="background"></div>

<?php



//$currentUsername = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
//$currentEmail = ($currentUsername !== null) ? $currentUsername["email"] : null;

//session_start();


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


$query2="SELECT * FROM users WHERE username='joshua'";
$cardresult=mysqli_query($conn,$query2);
$card = mysqli_fetch_assoc($cardresult);


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
    <span style="text-align: right; display: block;font-size: x-large;font-family: 'Baskerville Old Face'">Invoice<br>#<?php echo"$receiptnumber"?></span>
</div>


<style>
    table {

        border-collapse: collapse;
        margin-top:30px;
        margin-bottom: 30px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid cornflowerblue;
        border-right: none;
        border-left: none;
        border-top:none;

    }
    th{
        background: lightskyblue;
        color: white;
        border:none;
    }
    td.quantity {
        text-align:center;
    }
    .background{
        position: fixed;
        top: 0;
        left: 0;
        width:100%;
        min-height:100vh;
        background-image: url("background.png");
        background-position:center ;
        background-size: cover;
        padding 10px 10%;
        overflow:hidden;
        z-index: -1;
        opacity: 0.3;



    }
    *{
        font-family: "Palatino Linotype";
    }

</style>
<table id="table">

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


  ?>


</table>
<div id="summary">
    Visa:<?php echo $card['visa']; ?><span style="float: right; display: inline-block;">Subtotal: $<?php echo number_format($total, 2);?></span><br>
    Card:<?php echo $card['card number']; ?><span style="float: right; display: inline-block;">Tax(9%): <?php echo"$$tax"?></span><br>
    <span style="float: right; display: inline-block;">Total: <?php echo"$$final"?></span><br>
</div>
<p>
<p>
    Dear customer,<br>
    Thank you for choosing Crown Supermarket and deals, for<br>
    any refund please show this E-receipt with the product still<br>
    sealed within 7 days.Food items are non-refundable.
</p>
<form>

    your name:<input type="text" id="name" placeholder="name" required ><br>
    your email:<input type="email" id="email" placeholder="email id" required><br><br>


    <button type="submit" onclick="sendEmail(); return false;">Send an email</button>

</form>
</body>
</html>



