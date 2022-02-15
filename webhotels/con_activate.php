<?php
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$authorised = false; //ορισμός authorise όπως και στο form validation
$activation_key_correct = false; //flag για την διασταύρωση των κωδικών ενεργοποίσης λογαριασμού
try {
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username AND PASSWORD=:password"); //ετοιμασία sql ερωτήματος
    $sql_salt = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username"); //ετοιμασία sql ερωτήματος για την εύρεση salt
    $sql_salt->execute(array('username' => $username)); //θελουμε το salt για καθε user και το περναμε σαν παράμετρο
    while ($record = $sql_salt->fetch()) { //while-loop εύρεσης salt
        $salt = $record['SALT'];
    }
    $sql_salt->closeCursor(); //Απελευθέρωση πόρων στον server
    //έλενχος κωδικού πρόσβασης (κρυπτογράφηση κωδικού που έδωσε ο χρήστης
    //και σύγκριση με τον κρυπτογραφημένο κωδικό που υπάρχει ήδη στο database)
    $check_password = crypt($password, $salt);
    $password = $check_password; //αντιμετάθεση
    $sql->execute(array('username' => $username, 'password' => $password)); //εκτέλεση ερωτήματος
    $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
    if ($count > 0) { //εάν τα στοιχεία που δόθηκαν υπάρχουν στο database
        $authorised = true; //κάνε authorize τον χρήστη
    } else {
        $authorised = false; //αλλιώς όχι
    }
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Database: " . $e->getMessage();
    die("Αδυναμία δημιούργίας PDO Object");
}
try {
    $activation_key = trim($_POST['activate_key']); //λήψη κωδικού ενεργοποίησης
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username"); //ετοιμασία sql ερωτήματος
    $sql->execute(array('username' => $username));
    while ($record = $sql->fetch()) { //while-loop εύρεσης του κωδικού ενεργοποίησης
        $db_activation_key = $record['ACTIVATE_KEY'];
    }
    if ($activation_key == $db_activation_key) { //εαν ο κωδικός ενεργοποίησης είναι σωστός
        $activation_key_correct = true;
    }
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Database: " . $e->getMessage();
    die("Αδυναμία δημιούργίας PDO Object");
}
if ($authorised == true && $activation_key_correct == true) { //εάν όλα τα στοιχεία είναι σωστά
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare('UPDATE USERS SET ISACTIVATED=:is_activated WHERE USERNAME=:username'); //ετοιμασία sql ερωτήματος
        $is_activated = 1; //ενεργοποίηση λογιαριασμού (0 για false 1 για true)
        $sql->execute(array(':is_activated' => $is_activated, 'username' => $username)); //πέρασμα τιμών και εκτέλεση ερωτήματος
        $sql->closeCursor(); //απελευθέρωση πόρων στον server
        $pdo = null;
        header("Location: login.php?msg=Επιτυχής ενεργοποίηση λογαριασμού!");
        exit();
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα δημιούργιας εγγραφής στο Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας εγγραφής PDO Object");
    }
    //χειρισμός των υπόοιπων περιπτώσεων και δημιουργία κατάλληλου μυνήματος αντίστοιχα
} elseif ($authorised == true && $activation_key_correct == false) {
    header("Location: activate_account.php?msg=Λάθος κωδικός ενεργοποίησης!");
    exit();
} elseif ($authorised == false && $activation_key_correct == true) {
    header("Location: activate_account.php?msg=Λάθος κωδικός πρόσβασης ή username!");
    exit();
} elseif ($authorised == false && $activation_key_correct == false) {
    header("Location: activate_account.php?msg=Λάθος κωδικός πρόσβασης ή username και λαθος κωδικός ενεργοποίησης!");
    exit();
}
