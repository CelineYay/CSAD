<?php
include'index.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="Qrcode.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        #qrCodeContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }
        .payment_text {
            font-size: 24px;
            margin-top: 10px;
        }
        .bank_support_text {
            font-size: 16px;
            margin-top: 10px;
        }

        /*CSS rule to style the table borders*/
        table, th, td {
            border: 3px solid black;
        }

        /*CSS code to style the buttons*/
        .background {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .background:hover {
            background-color: #0056b3;
        }


        .payment_select input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .payment_select input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .redeem-section {
            text-align: center;
            padding: 20px;
        }

        .congratulations-message h1 {
            color: #28a745; /* Green color */
            margin-bottom: 10px;
        }

        .congratulations-message p {
            font-size: 20px;
            color: #333; /* Dark grey color */
        }


    </style>


    <script>

        // JavaScript function to toggle payment methods and QR code display
        function showCardPayment() {
            document.getElementById('card-form').style.display = 'block';
            document.getElementById('internet-banking').style.display = 'none';
            document.getElementById('redeem-points').style.display = 'none';
        }

        function showInternetBanking() {
            document.getElementById('card-form').style.display = 'none';
            document.getElementById('internet-banking').style.display = 'block';
            document.getElementById('redeem-points').style.display = 'none';

        }

        function showRedeemPoints() {
            document.getElementById('card-form').style.display = 'none';
            document.getElementById('internet-banking').style.display = 'none';
            document.getElementById('redeem-points').style.display = 'block';
        }

        // Set initial state and event listeners
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize to show card payment by default
            showCardPayment();

            // Event listeners
            document.getElementById('tColorA').addEventListener("click", showCardPayment);
            document.getElementById('tColorB').addEventListener("click", showInternetBanking);
            document.getElementById('tColorC').addEventListener("click", showRedeemPoints);
        });

    </script>

</head>

<body>
<?php ?>
<div class="container">
    <div class="left">
        <p> Payment methods</p>
        <hr style="border:1px solid #ccc; margin: 0 15px;">
        <div class="methods">
            <div onclick="showCardPayment()" id="tColorA" style="color: greenyellow;">
                <i class="fa-solid fa-credit-card" style="color: greenyellow;"> </i> Payment by Card
            </div>
            <div onclick="showInternetBanking()" id="tColorB">
                <i class=" fa-solid fa-building-columns"></i> Internet Banks
            </div>
            <div onclick="showPaypalButtons()" id="paypal-button-container" style="cursor:pointer;">
                <i class="fa-solid fa-building-columns"></i> Pay by Paypal
            </div>
            <script src="https://www.paypal.com/sdk/js?client-id=Ad1U25gbgNk88RkuucgxxtZxNO0TAPRsW5xfI8TAmZsyDy7u3PrCiVydlab7_fXDVqXaCzGzsySZet_8"></script>
            <div onclick="showRedeemPoints()" id="tColorC">
                <i class=" fa-solid fa-wallet"></i> Points Earned
            </div>
        </div>
        <hr style="border: 1px solid #ccc; margin: 0 15px;">
    </div>
    <div class="center">
        <a href="https://www.shift4shop.com/
            credit-card-logos.html"><img alt="Credit Card Logos" title="Credit Card Logos"
                                         src="https://www.shift4shop.com/images/credit-card-logos/cc-lg-4.png" width="250"
                                         height="auto" /></a>
        <hr style="border:1px solid #ccc; margin: 0 15px;">


        <!-- Points Earned Section -->
        <div id="redeem-points" style="display: none;">
            <div class="redeem-section">
                <div class="congratulations-message">
                    <h1>Congratulations!</h1>
                    <?php
                    $host = 'localhost';
                    $mySQLusername = 'ty';
                    $mySQLpassword = '123';
                    $database = 'csaduersdatabase';

                    $conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    $query2 = "SELECT * FROM users WHERE username='joshua'";
                    $userresult = mysqli_query($conn, $query2);

                    // Initialize $user even if the query fails
                    $user = ($userresult) ? mysqli_fetch_assoc($userresult) : null;
                    ?>
                    <p>You have earned <span id="points-earned"><?php echo $user['points'];?></span> points today!</p>
                </div>
            </div>
        </div>


        <!-- Internet Banks Section -->
        <div id="internet-banking" style="display: none;">
            <div class ="payment_select" id="qrCodeContainer">
                <form action="confirmation.html" method="post">
                    <img class="qr_code_image" id="qr-code-image" src="paynowQRcode.png" alt="QR Code for payment" style="max-width:300px;">
                    <h1 class="payment_text">SCAN TO PAY</h1>
                    <p class="bank_support_text">PayNow is supported by these participating Banks</p>
                    <p class="bank_support_text">Bank of China, Citibank, DBS/POSB, HSBC Bank, Industrial and Commercial Bank
                        of China Limited, Maybank, OCBC Bank, Standard Chartered Bank & United Overseas Bank Limited</p>
                    <input type="submit" value="PAYNOW" class="background" id="pay-now-btn">
                </form>
            </div>
        </div>
        <!-- Card Payment Section -->
        <div class="card-details" id="card-form">
            <form action="savecard.php" method="post">
                <p>Card number</p>
                <div class="c-number" id="c-number">
                    <input id="number" class="form-control" name="number" placeholder="Card Number" maxlength="19" required>
                    <i class="fa-solid fa-credit-card" style="margin: 0;"></i>
                </div>

                <div class="c-details">
                    <div>
                        <p> Expiry date</p>
                        <input id="e-date" class="cc-exp" class="form-control" placeholder="MM/YY" required
                               maxlength="5" required>
                    </div>
                    <div>
                        <p>CVV</p>
                        <div class="cvv-box" id="cvv-box">
                            <input id="cvv" class="cc-cvv" class="form-control" placeholder="CVV" required
                                   maxlength="3" required>
                            <i class="fa-solid fa-circle-question" title="3 digits on the back of the card"
                               style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <div class="email">
                    <p>Email</p>
                    <input type="email" class="form-control" placeholder="example@gmail.com" id="email" required>
                </div>
                <input type="submit" value="CHECKOUT" class="background" id="pay-now-btn">
            </form>
        </div>
    </div>
    <div class="right">
        <p> Order Information: <br>
            Your Purchases Will Be Displayed Below
        </p>
        <hr style="border: 1px solid #ccc; margin: 0 15px;">
        <div class="details">
            <div style="font-weight: bold; padding: 3px 0;">
                Order details
            </div>
            <style>
                table {

                    border-collapse: collapse;
                    margin-top:30px;
                    margin-bottom: 30px;
                    border: 3px solid;

                }

                th, td {
                    padding: 8px;
                    text-align: left;
                    border: 1px solid black;
                    border-right: none;
                    border-left: none;
                    border-top:none;

                }

                th, td {
                    border-right: none;
                    border-left: none;
                    border-top: none;
                }

                *{
                    font-family: "Palatino Linotype";
                }

            </style>
            <table id="products">
                <tr>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>

                </tr>
                <?php

                $host = 'localhost';
                $mySQLusername = 'ty';
                $mySQLpassword = '123';
                $database = 'csaduersdatabase';


                $conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error); }
                $all = mysqli_query($conn, "SELECT * FROM payables");
                // Fetch all rows from the result set and store them in an array
                $items = mysqli_fetch_all($all, MYSQLI_ASSOC);


                $query = "SELECT * FROM payables";
                $get = mysqli_query($conn, $query);
                $query2 = "SELECT * FROM users WHERE username='joshua'";
                $userresult=mysqli_query($conn, $query2);
                $user=mysqli_fetch_assoc($userresult);
                $total=0;
                foreach($items as $item){
                    echo"<tr>";
                    echo"<td>{$item['itemname']}</td>";
                    echo"<td>\${$item['price']}</td>";
                    echo"<td>\${$item['quantity']}</td>";
                    echo"<td>\${$item['finalitemprice']}</td>";
                    echo "</tr>";

                    $total += $item['price'] * $item['quantity'];
                }
                $tax=number_format($total/100*9,2);
                $final=$total+$tax;
                $points=$total*100;
                echo"</table>";
                echo"Tax:$$tax<br>";
                echo"Total:$$total<br>";
                echo"Points earned:$points points";





                ?>


        </div>
        <hr style="border:1px solid #ccc; margin: 0 15px;">
    </div>
</div>

<script src="card.js"></script>



</body>

</html>
