<?php
include 'index.php'
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crown Supermarket And Deals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sale-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 10px;
        }
        .sale-item {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: calc(50% - 20px);
            text-align: center;
        }
        .original-price {
            text-decoration: line-through;
            color: #999;
        }
        .sale-price {
            color: #d9534f;
            font-weight: bold;
        }
        .sale-label {
            color: #fff;
            background-color: #d9534f;
            padding: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="sale-grid">
    <!-- Repeat this block for each sale item -->
    <div class="sale-item">
        <span class="sale-label">Sale!</span>
        <img src="itemImages/apple.png" alt="Product Image" style="max-width:100%;">
        <div class="original-price">$20</div>
        <div class="sale-price">$10</div>
    </div>
    <div class="sale-item">
        <span class="sale-label">Sale!</span>
        <img src="itemImages/apple.png" alt="Product Image" style="max-width:100%;">
        <div class="original-price">$20</div>
        <div class="sale-price">$10</div>
    </div>
    <!-- ... other items ... -->
</div>
</body>
</html>

