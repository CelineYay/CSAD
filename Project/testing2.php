<?php
include 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipts</title>
</head>
<body>
<div class="background"></div>

<?php

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
$items = mysqli_fetch_all($all, MYSQLI_ASSOC);

$allreceipt = mysqli_query($conn, "SELECT * FROM receipt");
$receipts = mysqli_fetch_all($allreceipt, MYSQLI_ASSOC);
?>

<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    .receipt-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px; /* Distance between each receipt */
        padding: 20px;
    }

    .receipt-table {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    .receipt-header {
        background-color: #007bff;
        color: #fff;
        padding: 15px;
        font-size: 20px;
        border-bottom: 2px solid #006fe6;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .totals-row {
        font-weight: bold;
    }

    .amount-due {
        font-size: 1.2em;
    }

    .background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #e9ecef;
        z-index: -1;
        opacity: 0.5;
    }




</style>

<?php if (!empty($receipts)) : ?>
    <div class="receipt-container">
        <?php foreach ($receipts as $receipt) : ?>
            <table class="receipt-table">
                <tr>
                    <th colspan="4"><span style="font-size: x-large;">Receipt #<?php echo $receipt['receiptNumber']; ?></span></th>
                </tr>

                <tr>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Items Cost</th>
                </tr>

                <?php
                $total = 0;
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>{$item['itemname']}</td>";
                    echo "<td>\${$item['price']}</td>";
                    echo "<td class='quantity'>{$item['quantity']}</td>";
                    echo "<td>\$" . number_format($item['price'] * $item['quantity'], 2) . "</td>";
                    echo "</tr>";
                    $finalitemcost = $item['price'] * $item['quantity'];
                    $total += $item['price'] * $item['quantity'];
                }
                $tax = number_format($total / 100 * 9, 2);
                $final = $total + $tax;
                echo "<tr class='forthebottom'><td colspan='4'></td></tr>";
                ?>
                <tr>
                    <td colspan="3">Total</td>
                    <td>$<?php echo number_format($total, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Tax (9%)</td>
                    <td>$<?php echo $tax; ?></td>
                </tr>
                <tr>
                    <td colspan="3"><span style="font-size: x-large">Amount Due</span></td>
                    <td><span style="font-size: x-large">$<?php echo $final; ?></span></td>
                </tr>

            </table>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No receipts found.</p>
<?php endif; ?>

</body>
</html>

