<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destroy session data
$_SESSION = [];
session_destroy();

// Redirect to homepage
header('Location: /');
exit;
?>
