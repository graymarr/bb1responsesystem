<?php

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin_login.html");
    exit();
}
?>