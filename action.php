<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Database connection
    $servername = "localhost"; // Assuming your database is on localhost
    $username = "root"; // Your MySQL username
    $password_db = ""; // Your MySQL password
    $dbname = "shoebazaar";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: index.php");
    exit();
}

