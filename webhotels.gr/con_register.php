<?php
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$email = trim($_POST['email']);
$username_exists = false;
$email_exists = false;
//ΕΛΕΝΧΟΣ ΕΑΝ ΤΟ CAPTCHA έκανε ταυτοποίηση
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
if (!$captcha) {
    //το Captcha δεν συμπληρώθηκε
    header("Location: register.php?msg=Το CAPTCHA είναι κενό!");
    exit();
}
//αποδικοποίηση της απάντησης του captcha api (στέλνει data σε json)
$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdB-OAaAAAAANurp76Ao0fB-TkEuwv6_w-23iSz&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
if ($response['success'] == false) {
    //το Captcha είναι λάθος συμπληρωμένο
    header("Location: register.php?msg=Το CAPTCHA δεν συμπληρώθηκε σωστά! Προσπάθησε ξανά");
    exit();
} else {
    //ΕΛΕΝΧΟΣ ΕΑΝ ΤΟ USERNAME ΥΠΑΡΧΕΙ ΣΤΟ DATABASE
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
    if ($email_exists && $username_exists) {
        header("Location: register.php?msg=Το username είναι καταχωρημένο! Χρησιμοποιήστε κάποιο άλλο username! Το email είναι καταχωρημένο! Χρησιμοποιήστε κάποιο άλλο email!");
        exit();
    } elseif ($email_exists) {
        header("Location: register.php?msg=Το email είναι καταχωρημένο! Χρησιμοποιήστε κάποιο άλλο email!");
        exit();
    } elseif ($username_exists) {
        header("Location: register.php?msg=Το username είναι καταχωρημένο! Χρησιμοποιήστε κάποιο άλλο username!");
        exit();
    }
    if ($email_exists == false && $username_exists == false) {
        try {
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare('INSERT INTO USERS (USERNAME,PASSWORD,EMAIL,SALT,ACTIVATE_KEY,ISACTIVATED) VALUES (:username, :password ,:email,:salt,:activate_key,:is_activated)'); //ετοιμασία sql ερωτήματος
            $salt = '$6$' . rand(1000000000000000, 9999999999999999); //παραγωγή salt για SHA-512
            $activation_key = rand(10000, 99999); //παραγωγή 5-ψήφιου κωδικού ενεργοποίησης λογαριασμού
            $encryptedPass = crypt($password, $salt); //κρυπτογράφηση password
            $is_activated = 0; //αρχικοποίηση ενεργοποίησης λογιαριασμού (0 για false 1 για true)
            $sql->execute(array(':username' => $username, ':password' => $encryptedPass, ':email' => $email, ':salt' => $salt, ':activate_key' => $activation_key, ':is_activated' => $is_activated)); //πέρασμα τιμών και εκτέλεση ερωτήματος
            $sql->closeCursor(); //απελευθέρωση πόρων στον server
            $pdo = null;
            header("Location: activation_code.php?msg=Επιτυχής εγγραφή χρήστη!&code=$activation_key");
            exit();
        } catch (PDOException $e) { //χειρισμός PFO Exception
            print "Πρόβλημα δημιούργιας εγγραφής στο Database: " . $e->getMessage();
            die("Αδυναμία δημιούργίας εγγραφής PDO Object");
        }
    }
}
