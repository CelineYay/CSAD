<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="paypal-button-container"></div>
<script src="https://www.paypal.com/sdk/js?client-id=Ad1U25gbgNk88RkuucgxxtZxNO0TAPRsW5xfI8TAmZsyDy7u3PrCiVydlab7_fXDVqXaCzGzsySZet_8"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount:{
                        value:'299.99'
                    }
                }]
            });
        }
    }).render('#paypal-button-container')
</script>


</body>
</html>
