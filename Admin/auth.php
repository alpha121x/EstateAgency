<?php
session_start();
if (! $_SESSION['user_type']) {
    // echo "session is started";
    header('Location:login.php');
}
?>