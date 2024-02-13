<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Queried</title>
    <style>
        #main{
            display: flex;
        }
        #imgDiv{
            flex: 1;
            display: flex;
        }
        #infoDiv{
            flex: 1;
            display: flex;
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
    <script src="scannerLibrary.js">
        let count = 0;
        // QR format item name, image src file, price, promotion

    </script>
</head>
<body>
<div class="alert">
    <span class="closebtn" onclick="window.location.href = 'query.html';">&times;</span>
    scanned item named <B id="nameQueried">Item name</B>
</div>
<div id="main">
    <div id="imgDiv">
    </div>
    <div id="infoDiv">
        <table style="align-content: center; border-collapse: collapse; border: none; ">
            <tbody>
            <tr>
                <td>Name:</td>
                <td id="queryName"></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td id="queryPrice"></td>
            </tr>
            <tr id="queryPromoRow">
                <td>Promotion:</td>
                <td id="queryPromo"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Extract QR code message from URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const qrCodeMessage = urlParams.get('qrcode');

    // decode QR message
    function qrDecoder(qrCodeMessage){
        // Split the QR code message by comma
        let qrData = qrCodeMessage.split(',');
        let name = qrData[0].trim();
        let img = qrData[1].trim();
        let price = qrData[2].trim();
        let promotion = qrData[3].trim();

        // QR format item name, image src file, price, promotion
        let imgStr = 'itemImages/' + img;
        console.log(imgStr); // Check if the image path is constructed correctly

        // Set the image source
        let imgElement = document.createElement('img');
        imgElement.src = imgStr;
        document.getElementById("imgDiv").appendChild(imgElement);

        // Display other information as needed
        document.getElementById("queryName").textContent = name;
        //document.getElementById("queryPrice").textContent = "$" +price;
        document.getElementById("nameQueried").innerHTML = name;

        if (promotion === "0") {
            // no discount
            document.getElementById("queryPrice").textContent = "$" + price;
            document.getElementById("queryPromo").textContent = "None";
        } else {
            // discounted price and display promotion
            let discountedPrice = (price / 100) * (100 - promotion);
            document.getElementById("queryPrice").textContent = "Sale! $" + discountedPrice.toFixed(2);
            document.getElementById("queryPromo").textContent = promotion + "% Off";
            let queryPromo = document.getElementById("queryPromoRow");
            queryPromo.style.color = "white";
            queryPromo.style.backgroundColor = "green";
            queryPromo.style.borderRadius = "5px";
            queryPromo.style.fontWeight = "bold";
        }
    }

    qrDecoder(qrCodeMessage);
</script>

</body>
</html>
