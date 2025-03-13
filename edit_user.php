<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Database connection
    $conn = new mysqli('localhost:3307', 'root', '', 'contact_form_db');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "UPDATE contacts SET firstname=?, lastname=?, email=?, phone_number=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $firstname, $lastname, $email, $phone_number, $id);
    if ($stmt->execute()) {
        echo 'User updated successfully.';
    } else {
        echo 'Error updating user: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
