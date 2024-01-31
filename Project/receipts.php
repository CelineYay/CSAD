<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipts</title>
</head>
<body>

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

$all = mysqli_query($conn, "SELECT * FROM payables");
$items = mysqli_fetch_all($all, MYSQLI_ASSOC);

$allreceipt = mysqli_query($conn, "SELECT * FROM receipt");
$receipts = mysqli_fetch_all($allreceipt, MYSQLI_ASSOC);
?>

<style>
    .receipt-container {
        white-space: nowrap;
    }

    .receipt-table {
        border-collapse: collapse;
        border: 2px solid black;
        display: inline-block;
        margin-right: 20px;
    }

    th, td {
        border: none;
        padding: 8px;
        text-align: left;
    }
    .forthebottom {
        height: 300px;
        display: block;
    }



</style>

<?php if (!empty($receipts)) : ?>
    <div class="receipt-container">
        <?php foreach ($receipts as $receipt) : ?>
            <table class="receipt-table">
                <tr>
                    <th colspan="4">Receipt #<?php echo $receipt['receiptNumber']; ?></th>
                </tr>

                <tr>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>ItemCost</th>
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
                    <td colspan="3">Final Price</td>
                    <td>$<?php echo $final; ?></td>
                </tr>

            </table>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No receipts found.</p>
<?php endif; ?>

</body>
</html>
