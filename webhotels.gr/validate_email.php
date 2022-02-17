<?php
header("Cache-Control: no-cache, must-revalidate");//αποφυγή caching
header("Expires:0");
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    // ΕΛΕΝΧΟΣ ΕΑΝ ΤΟ EMAIL ΥΠΑΡΧΕΙ ΣΤΟ DATABASE
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT * FROM users WHERE EMAIL=:email"); //ετοιμασία sql ερωτήματος
        $sql->execute(array('email' => $email)); //σύγκριση στοιχείων με database
        $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
        if ($count > 0) { //εάν τα στοιχεία που δόθηκαν υπάρχουν στο database
            $email_exists = true;
        } else {
            $email_exists = false;
        }
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα εύρεσης email στο Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object email");
    }
    if ($email_exists) {
        echo 'Το email χρησιμοποιείται! Χρησιμοποιήστε κάποιο άλλο email!';
    }
}
