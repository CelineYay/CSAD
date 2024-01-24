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
            header('Location: index.php'); // Redirect to the index page
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
<form method="POST" action="login.php">
    <h1>Login</h1>
    <div>
    <label for="usernameemail">Username or Email:</label>
    <input type="text" name="usernameemail" id="usernameemail" placeholder="Username or Email" required value="">
    </div>
    <div>
    <label for="password">Password:</label>
    <input type="text" name="password" id="password" placeholder="Password" required value="">
    </div>
    <button type="submit" name="submit">Login</button>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</form>

</body>
</html>
