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
if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"]; //from the id
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$usernameemail' OR email='$usernameemail' ");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["login"] = TRUE;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"]; // Store username in session
            $_SESSION["email"] = $row["email"];
            header('Location: homelist.php'); // Redirect to the index page
            exit();

        }else{
            echo "<script>alert('Wrong Password');</script>";
        }

    }else{
        echo "<script>alert('User Not Registered');</script>";
    }
}
if(isset($_POST["submit1"])){
    $usernameemail = $_POST["usernameemail"]; //from the id
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM staffs WHERE username='$usernameemail' OR email='$usernameemail' ");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["login"] = TRUE;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"]; // Store username in session
            $_SESSION["email"] = $row["email"];
            header('Location: dashboard.php'); // Redirect to the index page
            exit();

        }else{
            echo "<script>alert('Wrong Password');</script>";
        }

    }else{
        echo "<script>alert('User Not Registered');</script>";
    }
}
// Close the database connection
$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    div {
        margin-bottom: 10px;
    }
</style>
<body>
<div class="wrapper">
    <form method="POST" action="login.php">
        <h1>Login</h1>
        <div class="input-box">
            <label for="usernameemail">Username or Email:</label>
            <input type="text" name="usernameemail" id="usernameemail" required value="">
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" required value="">
            <i class='bx bxs-lock-alt'></i>
        </div>
            <button type="submit" name="submit">Customer</button>
            <button type="submit" name="submit1">Staff</button>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register</a>
        </div>
</form>
</div>

</body>
</html>
