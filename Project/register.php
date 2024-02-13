
<!DOCTYPE html>
<?php
// Start a session
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

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $password = $_POST["password"];
    $repeatpassword = $_POST["repeatpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email' ");
    if(mysqli_num_rows($duplicate)>0) {
        echo "<script>alert('Username or Email Has Already Taken');</script>";
    }else {
        if ($password === $repeatpassword) {
            // Insert data into the database
            $query = "INSERT INTO users (username, email, phonenumber, password, repeatpassword) VALUES ('$username', '$email', '$phonenumber','$password','$repeatpassword')";

            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Registration Successful');</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            // Passwords do not match
            echo "<script>alert('Error: Passwords do not match.');</script>";
        }
    }

} else {
    echo "";
}
// Close the database connection
$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    div {
        margin-bottom: 10px;
    }
</style>
<body>
<div class="wrapper">
<form method="POST" action="register.php">
    <h1>Register</h1>
    <div class="input-box">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <i class='bx bx-child'></i>
    </div>
    <div class="input-box">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required value="">
        <i class='bx bx-envelope'></i>
    </div>
    <div class="input-box">
        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" id="phonenumber" required value="">
        <i class='bx bxs-phone'></i>
    </div>
    <div class="input-box">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required value="">
        <i class='bx bxs-lock-alt'></i>
    </div>
    <div class="input-box">
        <label for="repeatpassword">Repeat Password:</label>
        <input type="password" name="repeatpassword" id="repeatpassword" required value="">
        <i class='bx bxs-lock-alt'></i>
    </div>
    <div>
    <button type="submit" name="submit">Register</button>
    </div>
    <div class="login-link"v>
    <a href="login.php">Login</a>
    </div>
</form>
</div>



</body>
</html>
