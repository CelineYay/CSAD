
<?php
global $points;
include("card.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $card_number = $_POST['number'];

    $username = 'joel'; // Set the username

    // Database connection parameters
    $host = 'localhost';
    $usernameDB = 'ty'; // Replace with your MySQL username
    $password = '123'; // Replace with your MySQL password
    $database = 'csaduersdatabase';

    // Create connection
    $conn = new mysqli($host, $usernameDB, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the card number already exists for the user 'joshua'
    $query2 = "SELECT * FROM users WHERE username='joshua'";
    $cardresult = mysqli_query($conn, $query2);
    $card = mysqli_fetch_assoc($cardresult);

    // If the card number already exists for the user, display an error message
    if ($card && $card['card_number'] === $card_number) {
        echo "Error: Card number already exists for the user 'joshua'";
        exit();
    }


    // Prepare SQL statement
    $sql = "INSERT INTO users (points, card_number) VALUES ($points, $card_number)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $card_number);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect to confirmation page
        header("Location: confirmation.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


