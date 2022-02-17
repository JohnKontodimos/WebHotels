<?php
header("Cache-Control: no-cache, must-revalidate"); //αποφυγή caching
header("Expires:0");
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username"); //ετοιμασία sql ερωτήματος
        $sql->execute(array('username' => $username)); //σύγκριση στοιχείων με database
        $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
        if ($count > 0) { //εάν τα στοιχεία που δόθηκαν υπάρχουν στο database
            $username_exists = true;
        } else {
            $username_exists = false;
        }
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα ευρεσης username στο Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object username");
    }
    if ($username_exists) {
        echo 'Το username χρησιμοποιείται! Χρησιμοποιήστε κάποιο άλλο username!';
    }
}
