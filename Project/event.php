<?php
include'hello.php';
// Establish a database connection
$host = 'localhost';
$mySQLusername = 'ty';
$mySQLpassword = '123';
$database = 'csaduersdatabase';

$conn = new mysqli($host, $mySQLusername, $mySQLpassword, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

    if(isset($_POST['save-event'])) {
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];


    $query = "INSERT INTO tbl_event (title,start_date,end_date) VALUES ('$title', '$start_date', '$end_date')";

    if($conn->query($query) === TRUE)
    {
        header('location:calendar.php');
    }
    else
    {
        $msg = "Event not created";
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="stylesss.css" rel="stylesheet" type="text/css">
</head>
<style>
    :root {
        --primary-color: #007bff;
        --hover-color: #0056b3;
        --font-color: #333;
        --border-radius: 0.25rem;
        --box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
        color: var(--font-color);
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: var(--box-shadow);
        border-radius: 40px;
    }

    h1 {
        text-align: center;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: block;
        margin-bottom: .5rem;
    }

    .form-group input {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--font-color);
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 40px;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
    }

    button {
        width: 100%; /* Match the width of input fields */
        padding: 15px 0; /* Add some padding for better appearance */
        background-color: #4CAF50; /* A nice green color */
        color: white; /* White text color */
        border: none; /* No border */
        border-radius: 40px; /* Rounded corners */
        cursor: pointer; /* Change cursor to pointer on hover */
        font-size: 18px; /* Increase font size */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    button:hover {
        background-color: #45a049; /* Darken the button a bit when hovered */
    }

    /* Optional: Add some margin to the bottom of the button to separate it from the login link */
    button {
        margin-bottom: 20px;
    }

    .error {
        color: #dc3545;
        margin-top: .25rem;
        font-size: .875em;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
    }
</style>
<body>
<div class="container">
    <div class="table-responsive">
        <h1 align="center">Create Event</h1><br/>
        <div class="box">
            <form method="post" >
                <div class="form-group">
                    <label for="title">Enter Title of the Event</label>
                    <input type="text" name="title" id="title" placeholder="Enter Title" required
                           data-parsley-type="title" data-parsley-trigg
                           er="keyup" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" required
                           data-parsley-type="date" data-parsley-trigg
                           er="keyup" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="date">End Date</label>
                    <input type="date" name="end_date" id="end_date" required
                           data-parsley-type="date" data-parsley-trigg
                           er="keyup" class="form-control"/>
                </div>
                <button type="submit" id="save-event" name="save-event" value="Save Event">Save Event</button>
                <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
