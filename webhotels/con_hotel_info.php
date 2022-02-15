<?php
require 'db_connect.php'; //σύνδεση στο database
require 'db_params.php'; //παράμετροι σύνδεσης στο database
//ΛΉΨΗ ΤΙΜΩΝ ΑΠΟ ΤΟ FORM
$title = trim($_POST['title']);
$state = trim($_POST['state']);
$destination = trim($_POST['destination']);
$address = trim($_POST['address']);
$phone = $_POST['phone'];
$stars = $_POST['stars'];
//ορισμος των checkboxes σε false εαν δεν εχουν επιλεχθεί
if (!isset($_POST['rooms_opt_1'])) {
    $rooms_opt_1 = "false";
} else {
    $rooms_opt_1 = $_POST['rooms_opt_1'];
}
if (!isset($_POST['rooms_opt_2'])) {
    $rooms_opt_2 = "false";
} else {
    $rooms_opt_2 = $_POST['rooms_opt_2'];
}
if (!isset($_POST['rooms_opt_3'])) {
    $rooms_opt_3 = "false";
} else {
    $rooms_opt_3 = $_POST['rooms_opt_3'];
}
if (!isset($_POST['rooms_opt_4'])) {
    $rooms_opt_4 = "false";
} else {
    $rooms_opt_4 = $_POST['rooms_opt_4'];
}
if (!isset($_POST['rooms_opt_5'])) {
    $rooms_opt_5 = "false";
} else {
    $rooms_opt_5 = $_POST['rooms_opt_5'];
}
if (!isset($_POST['parking'])) {
    $parking = "false";
} else {
    $parking = $_POST['parking'];
}
if (!isset($_POST['Wi-Fi'])) {
    $wifi = "false";
} else {
    $wifi = $_POST['Wi-Fi'];
}
if (!isset($_POST['bar'])) {
    $bar = "false";
} else {
    $bar = $_POST['bar'];
}
if (!isset($_POST['restaurant'])) {
    $restaurant = "false";
} else {
    $restaurant = $_POST['restaurant'];
}
if (!isset($_POST['room-service'])) {
    $room_service = "false";
} else {
    $room_service = $_POST['room-service'];
}
if (!isset($_POST['24-hours-reception'])) {
    $reception = "false";
} else {
    $reception = $_POST['24-hours-reception'];
}
if (!isset($_POST['pets'])) {
    $pets = "false";
} else {
    $pets = $_POST['pets'];
}
if (!isset($_POST['pool'])) {
    $pool = "false";
} else {
    $pool = $_POST['pool'];
}
if (!isset($_POST['ac'])) {
    $ac = "false";
} else {
    $ac = $_POST['ac'];
}
if (!isset($_POST['gym'])) {
    $gym = "false";
} else {
    $gym = $_POST['gym'];
}
$description = $_POST['hotel-description'];
$mode = $_SESSION['mode']; //λήψη mode (εγγραφής ή εισαγωγής) από το session
if ($mode == 'insert') {
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare('INSERT INTO HOTELS (TITLE,STATE,DESTINATION,ADDRESS,PHONE,STARS,users_USERNAME,DESCRIPTION,rooms_opt_1,rooms_opt_2,rooms_opt_3,rooms_opt_4,rooms_opt_5,parking,wifi,bar,restaurant,room_service,24_hours_reception,pets,pool,ac,gym) VALUES (:title, :state ,:destination,:address,:phone,:stars,:username,:description,:rooms_opt_1,:rooms_opt_2,:rooms_opt_3,:rooms_opt_4,:rooms_opt_5,:parking,:wifi,:bar,:restaurant,:room_service,:24_hours_reception,:pets,:pool,:ac,:gym)'); //ετοιμασία sql ερωτήματος
        $username = $_SESSION['username'];
        $sql->execute(array(':title' => $title, ':state' => $state, ':destination' => $destination, ':address' => $address, ':phone' => $phone, ':stars' => $stars, ':username' => $username, ':description' => $description, ':rooms_opt_1' => $rooms_opt_1, ':rooms_opt_2' => $rooms_opt_2, ':rooms_opt_3' => $rooms_opt_3, ':rooms_opt_4' => $rooms_opt_4, ':rooms_opt_5' => $rooms_opt_5, ':parking' => $parking, ':wifi' => $wifi, ':bar' => $bar, ':restaurant' => $restaurant, ':room_service' => $room_service, ':24_hours_reception' => $reception, ':pets' => $pets, ':pool' => $pool, ':ac' => $ac, ':gym' => $gym)); //πέρασμα τιμών και εκτέλεση ερωτήματος
        $sql->closeCursor(); //απελευθέρωση πόρων στον server
        $pdo = null;
        header("Location: index.php?msg=Επιτυχής εισαγωγή στοιχείων επιχείρησης!");
        exit();
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα δημιούργιας εγγραφής στο Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας εγγραφής PDO Object");
    }
} elseif ($mode == 'update') {
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $username = $_SESSION['username'];
        $sql = $pdo->prepare("UPDATE hotels SET TITLE=:title, STATE=:state, DESTINATION=:destination, ADDRESS=:address, PHONE=:phone, STARS=:stars, DESCRIPTION=:description, rooms_opt_1=:rooms_opt_1, rooms_opt_2=:rooms_opt_2, rooms_opt_3=:rooms_opt_3, rooms_opt_4=:rooms_opt_4, rooms_opt_5=:rooms_opt_5, parking=:parking, wifi=:wifi, bar=:bar, restaurant=:restaurant, room_service=:room_service, 24_hours_reception=:reception, pets=:pets, pool=:pool, ac=:ac, gym=:gym WHERE users_USERNAME=:username"); //ετοιμασία sql ερωτήματος
        $sql->execute(array(':title' => $title, ':state' => $state, ':destination' => $destination, ':address' => $address, ':phone' => $phone, ':stars' => $stars, ':username' => $username, ':description' => $description, ':rooms_opt_1' => $rooms_opt_1, ':rooms_opt_2' => $rooms_opt_2, ':rooms_opt_3' => $rooms_opt_3, ':rooms_opt_4' => $rooms_opt_4, ':rooms_opt_5' => $rooms_opt_5, ':parking' => $parking, ':wifi' => $wifi, ':bar' => $bar, ':restaurant' => $restaurant, ':room_service' => $room_service, ':reception' => $reception, ':pets' => $pets, ':pool' => $pool, ':ac' => $ac, ':gym' => $gym)); //πέρασμα τιμών και εκτέλεση ερωτήματος
        $sql->closeCursor(); //απελευθέρωση πόρων στον server
        $pdo = null;
        header("Location: index.php?msg=Επιτυχής ενημέρωση στοιχείων επιχείρησης!");
        exit();
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα ενημέρωσης εγγραφής στο Database: " . $e->getMessage();
        die("Αδυναμία ενημέρωσης εγγραφής PDO Object");
    }
}
