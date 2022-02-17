<?php
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
require 'function_getGUID.php'; //δημιουργία guid
$username = $_SESSION['username']; //λήψη ονόματος χρήστη από το session
if ($_SESSION['image_mode'] == 'insert') {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name']; //λήψη αναγκαίων τιμών από τον πίνακα FILES για το αρχείο
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    //χρήση της σύναρτησης pathifo με παράμετρο το όνομα του αρχείου
    //και το flag PATHINFO_EXTENSION για να παρω το extension
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $image_caption = $_POST['image_caption'];
    $allowed_files = array('jpg'); //ορισμός πίνακα επιτρεπόμενων αρχείων για σύγκριση
    $correct_ext = false; //έστω ότι δεν έχω τον σωστό τύπο αρχείου
    $correct_size = false; //έστω ότι δεν έχω το σωστό μέγεθος αρχείου
    if (in_array($fileExt, $allowed_files)) { //εαν ο τύπος βρίσκεται στον πίνακα επιτρεπόμενων αρχείων
        $correct_ext = true;
    }
    if ($fileSize <= 300000) { //εαν το μέγεθος αρχείου δε ξεπερνά τα 300KB(γραμμένο σε bytes)
        $correct_size = true;
    }
    if ($correct_size == true && $correct_ext == true) { //εαν έχω σωστό μέγεθος και τύπο αρχείου
        try { //λήψη τίτλου ξενοδοχείου από τον πίνακα ξενοδοχείων
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT TITLE FROM hotels WHERE users_USERNAME=:username"); //ετοιμασία sql ερωτήματος για την εύρεση τίτλου
            $sql->execute(array('username' => $username));
            while ($record = $sql->fetch()) { //while-loop εύρεσης τίτλου
                $hotel_title = $record['TITLE'];
            }
            $sql->closeCursor(); //Απελευθέρωση πόρων στον server
            $pdo = null;
        } catch (PDOException $e) { //χειρισμός PFO Exception
            print "Πρόβλημα Database: " . $e->getMessage();
            die("Αδυναμία δημιούργίας PDO Object");
        }
        try {
            $fileNameNew = getGUID(); //συνάρτηση δημιουργίας guid
            $fileDestination = 'img/hotelimages/' . $fileNameNew . "." . $fileExt;
            move_uploaded_file($fileTmpName, $fileDestination);
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare('INSERT INTO images (idimages,image_name,image_caption,hotels_TITLE,hotels_users_USERNAME) VALUES (:imageid,:image_name,:image_caption,:title,:username)'); //ετοιμασία sql ερωτήματος
            $sql->execute(array(':imageid' => $fileNameNew, ':image_name' => $fileName, ':image_caption' => $image_caption, ':title' => $hotel_title, ':username' => $username)); //πέρασμα τιμών και εκτέλεση ερωτήματος
            $sql->closeCursor(); //απελευθέρωση πόρων στον server
            $pdo = null;
            header("Location: index.php?msg=Επιτυχής εισαγωγή εικόνας");
            exit();
        } catch (PDOException $e) { //χειρισμός PFO Exception
            print "Πρόβλημα δημιούργιας εγγραφής στο Database: " . $e->getMessage();
            die("Αδυναμία δημιούργίας εγγραφής PDO Object");
        }
    } elseif ($correct_size == false && $correct_ext == true) { //εαν δεν έχω ελένχω τις άλλες περιπτώσεις και βγάζω κατάλληλο μύνημα
        header("Location: hotelimages?msg=Μεγάλο μέγεθος αρχείου! Παρακαλώ χρησιμοποίηστε εικόνες μικρότερες των 300KB!");
        exit();
    } elseif ($correct_size == true && $correct_ext == false) {
        header("Location: hotelimages?msg=Λάθος τύπος αρχείου! Παρακαλώ χρησιμοποίηστε μόνο εικόνες JPG!");
        exit();
    } elseif ($correct_size == false && $correct_ext == false) {
        header("Location: hotelimages?msg=Μεγάλο μέγεθος αρχείου! Παρακαλώ χρησιμοποίηστε εικόνες μικρότερες των 300KB! Λάθος τύπος αρχείου!Παρακαλώ χρησιμοποίηστε μόνο εικόνες JPG!");
        exit();
    }
} elseif ($_SESSION['image_mode'] == 'delete') { //εάν γίνεται διαγραφή της εικόνας
    try {
        $image_id = $_SESSION['image_id']; //λήψη του image id από το session
        $path = "img/hotelimages/";
        $path .= $image_id; //με .= κάνω προσθήκη string στο τέλος του path
        $path .= ".jpg";
        if (file_exists($path)) { //έλενχος ύπαρξης του αρχείου με τη συνάρτηση file_exists(επιστρέφει true ή false)
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("DELETE FROM images WHERE idimages=:imageid"); //ετοιμασία sql ερωτήματος
            $sql->execute(array(':imageid' => $image_id)); //πέρασμα τιμών και εκτέλεση ερωτήματος
            $sql->closeCursor(); //απελευθέρωση πόρων στον server
            $pdo = null;
            if ($sql == true) {
                // αν εκτελέστηκε ΟΚ η εντολή
                unlink($path); //διαγραφή αρχείου από τον φάκελο img/hotelimages
                header('Location: index.php?msg=Επιτυχής Διαγραφή!');
                exit();
            } else {
                // αν ΔΕΝ εκτελέστηκε
                header('Location: index.php?msg=Πρόβλημα στην εκτέλεση της διαγραφής! Δεν έγινε διαγραφή!');
                exit();
            }
        } else { //αν δε βρέθηκε το αρχείο
            header('Location: index.php?msg=Το αρχείο δε βρέθηκε!');
            exit();
        }
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα ενημέρωσης εγγραφής στο Database: " . $e->getMessage();
        die("Αδυναμία ενημέρωσης εγγραφής PDO Object");
    }
}
