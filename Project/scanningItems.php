<?php
include'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .row{
            flex: 1;
            border: 2px;
        }
        .mainContainer{
            display: flex;
        }
        #itemsContainer{
            flex: 1;
            border: 2px;
            justify-content: center;
            align-items: center;
        }
        #QRreader{
            border: none !important;
            flex: 1;
            display: flex;
        }
        #reader{
            border: none !important;
        }
        table, td{
            border: none;
            margin: 5px;
            border-collapse: collapse;
        }
        .alert {
            padding: 20px;
            background-color: black;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: red;
        }
    </style>
</head>
<body>


<script src="scannerLibrary.js">
    let count = 0;

    function qrDecoder(name, img, price, promotion){
        // QR format item name, image src file, price, promotion
        let imgStr = 'itemImages/' + img;
        document.getElementById("imgDiv").innerHTML = "<img src='" + imgStr + "'>";
        document.getElementById("infoDiv").innerHTML = "";
</script>
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
    Please Enable camera and scan item QR code to add purchase
</div>

<div class="mainContainer">

    <div id="itemsContainer" style="width: 50%;">
        <h5 style="text-align: center">Items Scanned</h5>
        <table>
            <thead>
            <td style="width: 30%"></td>
            <td style="width: 50%">Item</td>
            <td style="width: 20%">Price / $</td>
            </thead>
            <tbody id="itemsQueryList">
            <!--items scanned listed here-->
            </tbody>
        </table>
        <table>
            <thead>
            <td style="width: 30%">Total: </td>
            <td style="width: 50%"></td>
            <td id="tt" style="width: 20%">$0.00</td> <!-- Initialize total price to $0.00 -->
            </thead>
        </table>
        <input type="button" value="Pay for purchase" onclick="purchasing()">
    </div>

    <div id="QRreader" class="col" style="width: 50%; height: auto; text-align: center; margin: 0 auto; position: relative; border: none;">
        <div id="reader"></div>
    </div>

</div>

<script type="text/javascript">
    let tt = 0; // Initialize total price variable

    function purchasing(){
        window.location.href = 'card.php'
    }


    function onScanSuccess(qrCodeMessage) {
        let qrData = qrCodeMessage.split(',');
        let name = qrData[0].trim();
        let img = qrData[1].trim();
        let price = parseFloat(qrData[2].trim()); // Convert price to a floating-point number
        let promotion = parseFloat(qrData[3].trim()); // Convert promotion to a floating-point number

        if (promotion === "0") {
            document.getElementById('itemsQueryList').innerHTML += '<tr>' +
                '<td>' + '<img style="width: 50px; height: 50px" src="itemImages/' + img + '">' + '</td>' +
                '<td>' + name + '</td>' +
                '<td>' + price.toFixed(2) + '</td>' +
                '</tr>';
            tt += price;
        } else {
            let discountedPrice = promotion === 0 ? price : (price / 100) * (100 - promotion);
            document.getElementById('itemsQueryList').innerHTML += '<tr>' +
                '<td>' + '<img style="width: 50px; height: 50px" src="itemImages/' + img + '">' + '</td>' +
                '<td>' + name + '</td>' +
                '<td>' + discountedPrice.toFixed(2) + '</td>' +
                '</tr>';
            tt += discountedPrice;
        }

        document.getElementById('tt').textContent = '$' + tt.toFixed(2);

        setTimeout(function() {
            // Wait 3 seconds to prevent multiple scanning
            document.getElementById('itemsQueryList').innerHTML += '';
        }, 3000);
    }

    function onScanError(errorMessage) {
        // Handle scan error

    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
</body>
</html>