<?php
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Query items</title>
    <style>
        body{
            margin-top: 80px;
            margin-left: 30px;
            margin-right: 30px;
        }
        #QRreader {
            border: none !important;
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
    // QR format item name, image src file, price, promotion
</script>

<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
    Please Enable camera and scan item QR code to query item
</div>

<div id="QRreader" class="col" style="width: 50%; height: auto; text-align: center; margin: 0 auto; position: relative">
    <div style="width:50%; align-content: center" id="reader"></div>
</div>


<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        window.location.href = 'queryedItems.php?qrcode='+qrCodeMessage;
        //document.getElementById('itemsQueryList').innerHTML += '<tr>'+qrCodeMessage+'</tr>'
    }
    function onScanError(errorMessage) {
        //handle scan error
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "QRreader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

</body>
</html>

