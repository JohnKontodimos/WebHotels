<?php
require 'db_params.php'; //παράμετροι και σύνδεση στο database
require 'db_connect.php';
$recordsPerPage = 4; //τέσσερα αποτελέσματα ανα σελίδα
//αρχικοποίηση και ορισμός τιμών
if (isset($_GET['search_dest'])) {$dest_searched = $_GET['search_dest'];}
if (isset($_GET['search_state'])) {$state_searched = $_GET['search_state'];}
if (isset($_GET['search_stars'])) {$stars_searched = $_GET['search_stars'];}
//ορισμός true σε οποια επιλογή επιλέχθηκε λόγω
//οτι στο select της φόρμας αναζήτησης επιστέφεται
//μόνο το πρώτο κομμάτι (πχ rooms_opt_1)
//και στο database η τιμές αυτες έχουν true ή false
if (isset($_GET['noofrooms'])) {
    $rooms_searched = $_GET['noofrooms'];
    if ($rooms_searched == 'rooms_opt_1') {$rooms_searched .= "='true'";}
    if ($rooms_searched == 'rooms_opt_2') {$rooms_searched .= "='true'";}
    if ($rooms_searched == 'rooms_opt_3') {$rooms_searched .= "='true'";}
    if ($rooms_searched == 'rooms_opt_4') {$rooms_searched .= "='true'";}
    if ($rooms_searched == 'rooms_opt_5') {$rooms_searched .= "='true'";}
}
//ΔΗΜΙΟΥΡΓΙΑ ΠΙΘΑΝΩΝ ΣΥΝΔΥΑΣΜΩΝ ΑΝΑΖΗΤΗΣΗΣ
$query = ""; //αρχικοποίση string που θα περαστεί παρακάτω στο where μεσα στο sql ερώτημα
//μόνο πόλη επιλεγμένη
if (isset($dest_searched) && !isset($state_searched) && !isset($stars_searched) && (isset($rooms_searched) == "")) {
    $query .= "DESTINATION='$dest_searched'";
}
//μόνο νομός επιλεγμένος
if (isset($state_searched) && !isset($dest_searched) && !isset($stars_searched) && isset($rooms_searched) == "") {
    $query .= "STATE='$state_searched'";
}
//μόνο πόλη και νομός επιλεγμένα
if ((isset($dest_searched) && isset($state_searched)) && !isset($stars_searched) && (isset($rooms_searched) == "")) {
    $query .= "DESTINATION='$dest_searched'";
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
}
//μόνο αστέρια επιλεγμένα
if (isset($stars_searched) && !isset($dest_searched) && !isset($state_searched) && (isset($rooms_searched) == "")) {
    $query .= "STARS=$stars_searched";
}
//μόνο πόλη και αστέρια
if (isset($stars_searched) && isset($dest_searched) && !isset($state_searched) && (isset($rooms_searched) == "")) {
    $query .= "STARS=$stars_searched";
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
}
//μόνο αριθμός δωματίων επιλεγμένος
if (($rooms_searched != "") && !isset($dest_searched) && !isset($state_searched) && !isset($stars_searched)) {
    $query .= $rooms_searched;
}
//μόνο αριθμός δωματίων  και αστέρια επιλεγμένα
if (($rooms_searched != "") && !isset($dest_searched) && !isset($state_searched) && isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
}
//μόνο πόλη και αριθμός δωματίων επιλεγμένα
if (($rooms_searched != "") && isset($dest_searched) && !isset($state_searched) && !isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
}
//μόνο αστέρια και νομός επιλεγμένα
if (isset($stars_searched) && isset($state_searched) && !isset($dest_searched) && (isset($rooms_searched) == "")) {
    $query .= "STATE='$state_searched'";
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
}
//μόνο νομός και αρ. δωματίων επιλεγμένα
if (($rooms_searched != "") && isset($state_searched) && !isset($dest_searched) && !isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
}
//μόνο πόλη, νομός και αστέρια επιλεγμένα
if (isset($stars_searched) && isset($state_searched) && isset($dest_searched) && ($rooms_searched == "")) {
    $query .= "STARS=$stars_searched";
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
}
//μόνο πόλη, νομός και αρ. δωματίων επιλεγμένα
if (($rooms_searched != "") && isset($state_searched) && isset($dest_searched) && !isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
}
//μόνο νομός, αστέρια και αρ. δωματίων επιλεγμένα
if (($rooms_searched != "") && isset($state_searched) && !isset($dest_searched) && isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
}
//μόνο πόλη, αστέρια και αρ. δωματίων επιλεγμένα
if (($rooms_searched != "") && !isset($state_searched) && isset($dest_searched) && isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
}
//μόνο πόλη, αστέρια και αρ. δωματίων επιλεγμένα
if (($rooms_searched != "") && !isset($state_searched) && isset($dest_searched) && isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
}
//πόλη,νομός,αστέρια και αρ. δωματίων επιλεγμένα(όλα επιλεγμένα)
if (($rooms_searched != "") && isset($state_searched) && isset($dest_searched) && isset($stars_searched)) {
    $query .= $rooms_searched;
    $query .= " AND ";
    $query .= "DESTINATION='$dest_searched'";
    $query .= " AND ";
    $query .= "STARS=$stars_searched";
    $query .= " AND ";
    $query .= "STATE='$state_searched'";
}
try {
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT COUNT(TITLE) as recCount FROM hotels WHERE $query");
    $sql->execute();
    $record = $sql->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($record['recCount'] / $recordsPerPage); //υπολογισμός σελίδων
    $_SESSION['pages'] = $pages; //χρήση session για την αποθήκευση του αριθμού σελίδων
    $_SESSION['query'] = $query; //και του ερωτήματος $query
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    header('Location:hotelsearch.php');
    exit();
    $record = null;
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Eύρεσης Εγγραφών: " . $e->getMessage();
    die();
}
