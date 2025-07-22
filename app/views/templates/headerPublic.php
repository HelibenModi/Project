<?php
if (isset($_SESSION['auth']) == 1) {
    header('Location: /home');
}
?>

<!DOCTYPE html>
<html lang="en">
    
    <link rel="icon" href="/favicon.png">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>COSC 4806</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>