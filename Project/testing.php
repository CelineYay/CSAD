<?php

include 'index.php';

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

$query2 = "SELECT * FROM users WHERE username='joshua'";
$cardresult = mysqli_query($conn, $query2);
$card = mysqli_fetch_assoc($cardresult);

if ($get) {
    $row = mysqli_fetch_assoc($get);
    $receiptnumber = $row['max_receiptnumber'];
} else {
    // Handle the query error
    echo "Error: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F5F5F5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            max-width: 100px;
        }

        .invoice-number {
            font-size: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .summary {
            margin-top: 20px;
            text-align: right;
        }

        .summary span {
            display: block;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        @media screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 10px;
            }
        }
    </style>
</head>
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
<body>
<div class="container">
    <header>
        <img src="crown.png" alt="Crown Supermarket">
        <div class="invoice-number">Invoice #<?php echo $receiptnumber; ?></div>
    </header>

    <table>
        <tr>
            <th>Items</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
        $total = 0;
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>{$item['itemname']}</td>";
            echo "<td>\${$item['price']}</td>";
            echo "<td class='quantity'>{$item['quantity']}</td>";
            echo "<td>\$" . number_format($item['finalitemprice'], 2) . "</td>";
            echo "</tr>";

            $total += $item['price'] * $item['quantity'];
        }
        $tax = number_format($total / 100 * 9, 2);
        $final = $total + $tax;
        mysqli_query($conn, "INSERT INTO receipt (receiptNumber, cost, tax, finalPrice) VALUES ($receiptnumber, $total, $tax, $final)");
        ?>
    </table>

    <div class="summary">
        Visa: <?php echo $card['visa']; ?><span>Subtotal: $<?php echo number_format($total, 2); ?></span><br>
        Card: <?php echo $card['card number']; ?><span>Tax(9%): $<?php echo $tax; ?></span><br>
        <span>Total: $<?php echo $final; ?></span><br>
    </div>
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

    <div class="footer">
        Thank you for choosing Crown Supermarket.
    </div>
</div>
</body>
</html>
