<?php require 'function_getCSS.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
$style = getCSS();
echo "<link href='$style' rel='stylesheet' type='text/css'/>"?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <a href="index.php" class="logo">Web<span>Hotels</span></a>
        <nav>
            <ul>
                <li><a href="index.php">Αρχική</a></li>
            </ul>
        </nav>
    </header>