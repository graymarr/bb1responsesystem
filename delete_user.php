<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Database connection
    $conn = new mysqli('localhost:3307', 'root', '', 'contact_form_db');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "DELETE FROM contacts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo 'User deleted successfully.';
    } else {
        echo 'Error deleting user: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
