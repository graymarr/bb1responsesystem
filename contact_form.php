<?php
// Database configuration
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "contact_form_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input data
$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$phone_number = htmlspecialchars($_POST['phone_number']);


if (!$email) {
    echo "Invalid email format";
    exit;
}

// Insert data into the database
$sql = "INSERT INTO contacts (firstname, lastname, email, phone_number)
        VALUES ('$firstname', '$lastname', '$email', '$phone_number')";

if ($conn->query($sql) === TRUE) {
    echo "Form submitted!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
