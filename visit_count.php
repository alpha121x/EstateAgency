<?php
$cookieName = 'visit_count';

// Check if the cookie is set
if (isset($_COOKIE[$cookieName])) {
    $visitCount = $_COOKIE[$cookieName];
} else {
    $visitCount = 1;
}

// Set the updated count in the cookie
setcookie($cookieName, $visitCount, time() + 3600 * 24); // Cookie expires in 24 hours


?>

