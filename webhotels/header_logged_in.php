<?php require 'function_getCSS.php';?>
<!DOCTYPE html>
<html lang="en">
<!-- Header και nav menu διαπιστευμένου χρήστη -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
$style = getCSS();
echo "<link href='$style' rel='stylesheet' type='text/css'/>"?>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- javascript αρχείο ελένχου των πληροφορίων μίας εισαγόμενης επιχείρησης -->
    <script src="validate_hotelinfo_form.js" defer></script>
    <!-- javascript που δειχνει την εικονα -->
    <script src="preview_Image.js" defer></script>
    <!-- javascript που ελένχει εάν χρησιμοποιήθηκε τουλάχιστον ένα από τα πεδία αναζήτησης -->
    <script src="validate_search.js" defer></script>
    <!--  javascript που ελένχει την εικόνα-->
    <script src="validate_images.js" defer></script>
    <title><?php echo $title; ?></title>
</head>

<body>
    <header>
        <a href="index.php" class="logo">Web<span>Hotels</span></a>
        <nav>
            <ul>
                <li class="loggedin">
                    <a href="#"><img src="img/account-user-icon.jpg" alt="#" />
                        <p class="username"><?php echo $_SESSION['username'] ?></p>
                    </a>
                    <div class="loggedin-dropdown">
                        <a href="hotelinfo.php"><img src="img/edit-icon.jpg" alt="#" />Στοιχεία Επιχείρησης</a>
                        <a href="hotelimages.php"><img src="img/images-icon.jpg" alt="#" />Εικόνα Επιχείρησης</a>
                        <a href="logout.php"><img src="img/account-disconnect-icon.jpg" alt="#" />Αποσύνδεση</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>