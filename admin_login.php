<?php

include 'connect.php';

if(isset($_POST['signIn'])) {
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: admin.php");
            exit();
        } else {
            echo "Not Found, Incorrect Email or Password";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

?>

