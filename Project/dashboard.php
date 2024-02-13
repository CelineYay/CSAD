<?php
include('index2.php');

// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Write an SQL query to count the number of distinct usernames
$user_count_query = "SELECT COUNT(DISTINCT username) AS user_count FROM users";

// Execute the query
$user_count_result = $conn->query($user_count_query);

// Fetch the result
if ($user_count_result) {
    $user_count_row = $user_count_result->fetch_assoc();
    $num_usernames = $user_count_row['user_count'];
} else {
    $num_usernames = 0; // In case there is an error executing the query
}

// Write an SQL query to count the number of distinct usernames
$receipt_count_query = "SELECT COUNT(DISTINCT receiptNumber) AS invoice_count FROM receipt";

// Execute the query
$receipt_count_result = $conn->query($receipt_count_query);

// Fetch the result
if ($receipt_count_result) {
    $receipt_count_row = $receipt_count_result->fetch_assoc();
    $receipt_usernames = $receipt_count_row['invoice_count'];
} else {
    $receipt_usernames = 0; // In case there is an error executing the query
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #333;
            margin-top: 70px;
        }
        .content {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #ffffff;
            padding: 20px 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .box {
            display: inline-block;
            width: calc(25% - 30px);
            margin: 0 15px;
            background: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .box h3 {
            margin-top: 0;
            color: #555;
        }
        .box p {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        .sales-report table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .sales-report th,
        .sales-report td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        .sales-report th {
            background-color: #f9fafb;
            font-weight: 600;
        }
        .sales-report tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="header">
        <h2>Dashboard</h2>
        <p>Today is Wednesday, 14 February 2024</p>
        <p>Current Time</p>
        <p id="current-time"></p>


    </div>

    <div class="box">
        <h3>Number of Clients</h3>
        <p><?php echo htmlspecialchars($num_usernames); ?></p>
    </div>
    <div class="box">
        <h3>Daily Sales</h3>
        <p>59,423</p>
    </div>
    <div class="box">
        <h3>New Invoice</h3>
        <p><?php echo htmlspecialchars($receipt_usernames); ?></p>
    </div>

</div>
<script>
    let time = document.getElementById("current-time");

    setInterval(()=>{
        let d = new Date();
        time.innerHTML = d.toLocaleTimeString(); //fixed time
    },1000)

</script>
</body>
</html>

