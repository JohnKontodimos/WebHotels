<?php
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
//έλενχος εαν η φόρμα έχει συμπληρωθεί
if (!isset($_SESSION['username']) && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $authorised = false; //ορισμός authorise όπως και στο form validation
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username AND PASSWORD=:password"); //ετοιμασία sql ερωτήματος
        $sql_salt = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username"); //ετοιμασία sql ερωτήματος για την εύρεση salt
        $sql_salt->execute(array('username' => $username)); //θελουμε το salt για καθε user και το περναμε σαν παράμετρο
        while ($record = $sql_salt->fetch()) { //while-loop εύρεσης salt
            $salt = $record['SALT'];
        }
        $sql_salt->closeCursor(); //Απελευθέρωση πόρων στον server
        $check_password = crypt($password, $salt); //κανω encrypt τον κωδικό που δώθηκε με το salt που αντιστοιχεί στον κάθε χρήστη
        $password = $check_password; //μετάθεση και σύγκριση με τον ecnrypted κωδικό του database
        $sql->execute(array('username' => $username, 'password' => $password));
        $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
        if ($count > 0) { //εάν είναι ιδιος με τον encrypted κωδικό του database
            $authorised = true; //κάνε authorize τον χρήστη
        } else {
            $authorised = false;
        }
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object");
    }
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT * FROM users WHERE USERNAME=:username"); //ετοιμασία sql ερωτήματος για την κωδικού ενεργοποίησης
        $sql->execute(array('username' => $username)); //θελουμε τον κωδικό ενεργοποίησης για καθε user και το περναμε σαν παράμετρο
        while ($record = $sql->fetch()) { //while-loop εύρεσης εάν είναι ενεργοποιημένος ο λογιαριασμός
            $is_activated = $record['ISACTIVATED']; //επιστρέφει 1 για ενεργοποιημένο χρήστη και 0 για το αντίθετο
        }
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object");
    }
    if ($authorised == true && $is_activated == 1) {
        session_start(); //εαν είναι authorized στείλε τον χρήστη στην κεντρική σελιδα με αντίστοιχο μύνημα
        $_SESSION["username"] = $_POST["username"]; //δώσε το username που δώθηκε στο session
        header("Location: index.php?msg=Επιτυχής σύνδεση χρήστη!");
        exit();
    } elseif ($authorised == true && $is_activated == 0) { //εαν δεν είναι authorized βγάλε στον χρήστη μύνημα λάθους
        header("Location: activate_account.php?msg=Παρακαλώ ενεργοποίηστε τον λογαριασμό σας");
        exit();
    } elseif ($authorised == false) { //εαν δεν είναι authorized βγάλε στον χρήστη μύνημα λάθους
        header("Location: login.php?msg=Λάθος username ή password!");
        exit();
    }
} else {
    session_start();
    session_destroy(); //καταστροφή του session προληπτικά και δημιουργία μηνύματος
    header("Location: index.php?msg=Πρόβλημα - Δοκίμασε ξανά!");
    exit();
}
