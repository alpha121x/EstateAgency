<?php
session_start();
if (! $_SESSION['user']) {
    // echo "session is started";
    header('Location:index');
}
?>