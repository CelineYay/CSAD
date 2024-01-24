<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>
<h1>Inventory</h1>

<form action="#" method="post">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">

    <label for="category">Category:</label>
    <select name="category" id="category">
        <option value="">All</option>
        <option value="Category1">Category 1</option>
        <option value="Category2">Category 2</option>
        <!-- Add more categories as needed -->
    </select>

    <label for="supplier">Supplier:</label>
    <select name="supplier" id="supplier">
        <option value="">All</option>
        <option value="Supplier1">Supplier 1</option>
        <option value="Supplier2">Supplier 2</option>
        <!-- Add more suppliers as needed -->
    </select>

    <button type="submit">Filter</button>
</form>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Supplier</th>
        <th>Category</th>
        <th>Price</th>
        <th>Last Count</th>
        <th>Promotion Price</th>
    </tr>
    <!-- Sample data, replace with your actual data -->
    <tr>
        <td>Item 1</td>
        <td>Supplier 1</td>
        <td>Category 1</td>
        <td>$10.00</td>
        <td>50</td>
        <td>$8.00</td>
    </tr>
    <tr>
        <td>Item 2</td>
        <td>Supplier 2</td>
        <td>Category 2</td>
        <td>$15.00</td>
        <td>30</td>
        <td>$12.00</td>
    </tr>
    <!-- Add more rows as needed -->
</table>
</body>
</html>

