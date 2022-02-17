<?php
session_start();
$title = "WebHotels: Στοιχεία Επιχείρησης";
require 'header_logged_in.php';
if (!isset($_SESSION['username'])) { //έλενχος εάν ο χρήστης δεν είναι συνδεμένος
    header("Location: login.php?msg=Πρέπει να είσαι συνδεδεμένος για την προσθήκη της επειχήρησης σου!");
}
$mode = 'insert';
require 'db_params.php';
require 'db_connect.php';
$username = $_SESSION['username'];
try {
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE users_USERNAME=:username"); //ετοιμασία sql ερωτήματος
    $sql->execute(array('username' => $username));
    $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
    if ($count > 0) { //εάν τα στοιχεία που δόθηκαν υπάρχουν στο database
        $mode = 'update'; //και κάνε authorize τον χρήστη
    } else {
        $mode = 'insert';
    }
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Database: " . $e->getMessage();
    die("Αδυναμία δημιούργίας PDO Object");
}
if ($mode == 'update') {
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT TITLE,STATE,DESTINATION,ADDRESS,PHONE,STARS,DESCRIPTION,rooms_opt_1,rooms_opt_2,rooms_opt_3,rooms_opt_4,rooms_opt_5,parking,wifi,bar,restaurant,room_service,24_hours_reception,pets,pool,ac,gym FROM hotels WHERE users_USERNAME=:username"); //ετοιμασία sql ερωτήματος
        $sql->execute(array(':username' => $username));
        while ($record = $sql->fetch()) { //while-loop εύρεσης στοιχείων
            $TITLE = $record['TITLE'];
            $STATE = $record['STATE'];
            $DESTINATION = $record['DESTINATION'];
            $ADDRESS = $record['ADDRESS'];
            $PHONE = $record['PHONE'];
            $STARS = $record['STARS'];
            $DESCRIPTION = $record['DESCRIPTION'];
            $ROOMS_OPT_1 = $record['rooms_opt_1'];
            $ROOMS_OPT_2 = $record['rooms_opt_2'];
            $ROOMS_OPT_3 = $record['rooms_opt_3'];
            $ROOMS_OPT_4 = $record['rooms_opt_4'];
            $ROOMS_OPT_5 = $record['rooms_opt_5'];
            $PARKING = $record['parking'];
            $WIFI = $record['wifi'];
            $BAR = $record['bar'];
            $RESTAURANT = $record['restaurant'];
            $ROOM_SERVICE = $record['room_service'];
            $RECEPTION = $record['24_hours_reception'];
            $PETS = $record['pets'];
            $POOL = $record['pool'];
            $AC = $record['ac'];
            $GYM = $record['gym'];
        }
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object");
    }
}
$_SESSION['mode'] = $mode;
?>
<main style="height: 2000px;">
<!-- Παρακάτω συμπληρώνω τις τιμές εάν το mode είναι insert και εχουν βρεθει απο το sql παραπάνω -->
    <div class="hotel-info-bg">
        <form id="hotel-info-form" method="POST" action="con_hotel_info.php" onsubmit="return validate_hotelinfo_form()">
            <h3>Στοιχεία της Επιχείρησης σας</h3>
            <div class="hotel-info-form-container">
                <p>Τίτλος:</p>
                <div class="title">
                    <input type="text" name="title" id="title" value="<?php if (isset($TITLE)) {
    echo $TITLE;
}?>" required>
                </div>
                <p>Νομός:</p>
                <div class="state">
                    <input type="text" name="state" id="state" value="<?php if (isset($STATE)) {
    echo $STATE;
}?>" required>
                </div>
                <p>Προορισμός(Πόλη/Νησί):</p>
                <div class="destination">
                    <input type="text" name="destination" id="destination" value="<?php if (isset($DESTINATION)) {
    echo $DESTINATION;
}?>" required>
                </div>
                <p style="font-size:20px">Διεύθυνση(Οδός & Αριθμός):</p>
                <div class="address">
                    <input type="text" name="address" id="address" value="<?php if (isset($ADDRESS)) {
    echo $ADDRESS;
}?>" required>
                </div>
                <p>Τηλέφωνο:</p>
                <div class="telephone">
                    <input type="tel" name="phone" id="phone" value="<?php if (isset($PHONE)) {
    echo $PHONE;
}?>" required>
                </div>
                <p>Αριθμός Δωματίων</p>
                <div class="rooms">
                    <input type="checkbox" name="rooms_opt_1" id="rooms_opt_1" value="true" <?php if (isset($ROOMS_OPT_1) && $ROOMS_OPT_1 == 'true') {
    echo 'checked="checked"';
}?>>
                    <label for="rooms_opt_1">1 ενήλικας 1 δωμάτιο</label>
                    <br>
                    <input type="checkbox" name="rooms_opt_2" id="rooms_opt_2" value="true" <?php if (isset($ROOMS_OPT_2) && $ROOMS_OPT_2 == 'true') {
    echo 'checked="checked"';
}?>>
                    <label for="rooms_opt_2">2 ενήλικες 1 δωμάτιο</label>
                    <br>
                    <input type="checkbox" name="rooms_opt_3" id="rooms_opt_3" value='true' <?php if (isset($ROOMS_OPT_3) && $ROOMS_OPT_3 == 'true') {
    echo 'checked="checked"';
}?>>
                    <label for="rooms_opt_3">2 ενήλικες 1 παιδί 1 δωμάτιο</label>
                    <br>
                    <input type="checkbox" name="rooms_opt_4" id="rooms_opt_4" value="true" <?php if (isset($ROOMS_OPT_4) && $ROOMS_OPT_4 == 'true') {
    echo 'checked="checked"';
}?>>
                    <label for="rooms_opt_4">2 ενήλικες 2 παιδιά 1 δωμάτιο</label>
                    <br>
                    <input type="checkbox" name="rooms_opt_5" id="rooms_opt_5" value="true" <?php if (isset($ROOMS_OPT_5) && $ROOMS_OPT_5 == 'true') {
    echo 'checked="checked"';
}?>>
                    <label for="rooms_opt_5">2 ενήλικες 2 παιδιά 2 δωμάτια</label>
                </div>
                <p>Αριθμός Αστεριών:</p>
                <div class="stars">
                    <select name="stars" id="stars">
                        <option value="0" disabled selected hidden>Αριθμός Αστέρων</option>
                        <option value="1" <?php if (isset($STARS) && $STARS == 1) {
    echo 'selected="selected"';
}?>>1 Αστέρι</option>
                        <option value="2" <?php if (isset($STARS) && $STARS == 2) {
    echo 'selected="selected"';
}?>>2 Αστέρων</option>
                        <option value="3" <?php if (isset($STARS) && $STARS == 3) {
    echo 'selected="selected"';
}?>>3 Αστέρων</option>
                        <option value="4" <?php if (isset($STARS) && $STARS == 4) {
    echo 'selected="selected"';
}?>>4 Αστέρων</option>
                        <option value="5" <?php if (isset($STARS) && $STARS == 5) {
    echo 'selected="selected"';
}?>>5 Αστέρων</option>
                    </select>
                </div>
                <p>Παροχές:</p>
                <div class="facilities-container">
                    <input type="checkbox" name="parking" id="parking" value="true" <?php if (isset($PARKING) && $PARKING == 'true') {
    echo 'checked="checked"';
}?>><img src="img/parking-icon.jpg" alt="#"><label for="parking">Παρκιγκ</label>
                    <br>
                    <input type="checkbox" name="Wi-Fi" id="Wi-Fi" value="true" <?php if (isset($WIFI) && $WIFI == 'true') {
    echo 'checked="checked"';
}?>><img src="img/wifi-icon.jpg" alt="#"><label for="Wi-Fi">Δωρεάν Wi-Fi Internet</label>
                    <br>
                    <input type="checkbox" name="bar" id="bar" value="true" <?php if (isset($BAR) && $BAR == 'true') {
    echo 'checked="checked"';
}?>><img src="img/bar-icon.jpg" alt="#"><label for="bar">Μπαρ</label>
                    <br>
                    <input type="checkbox" name="restaurant" id="restaurant" value="true" <?php if (isset($RESTAURANT) && $RESTAURANT == 'true') {
    echo 'checked="checked"';
}?>><img src="img/restaurant-icon.jpg" alt="#"><label for="restaurant">Εστιατόριο</label>
                    <br>
                    <input type="checkbox" name="room-service" id="room-service" value="true" <?php if (isset($ROOM_SERVICE) && $ROOM_SERVICE == 'true') {echo 'checked="checked"';}?>><img src="img/room-service-icon.jpg" alt="#"><label for="room-service">Υπηρεσία δωματίου</label>
                    <br>
                    <input type="checkbox" name="24-hours-reception" id="24-hours-reception" value="true" <?php if (isset($RECEPTION) && $RECEPTION == 'true') {
    echo 'checked="checked"';
}?>><img src="img/24-hours-reception-icon.jpg" alt="#"><label for="24-hours-reception">24ωρη
                        Ρεσεψιόν</label>
                    <br>
                    <input type="checkbox" name="pets" id="pets" value="true" <?php if (isset($PETS) && $PETS == 'true') {
    echo 'checked="checked"';
}?>><img src="img/pets-icon.jpg" alt="#"><label for="pets">Kατοικίδια</label>
                    <br>
                    <input type="checkbox" name="pool" id="pool" value="true" <?php if (isset($POOL) && $POOL == 'true') {
    echo 'checked="checked"';
}?>><img src="img/pool-icon.jpg" alt="#"><label for="pool">Πισίνα</label>
                    <br>
                    <input type="checkbox" name="ac" id="ac" value="true" <?php if (isset($AC) && $AC == 'true') {
    echo 'checked="checked"';
}?>><img src="img/air-conditioner-icon.jpg" alt="#"><label for="ac">Κλιματισμός</label>
                    <br>
                    <input type="checkbox" name="gym" id="gym" value="true" <?php if (isset($GYM) && $GYM == 'true') {
    echo 'checked="checked"';
}?>><img src="img/gym-icon.jpg" alt="#"><label for="gym">Γυμναστήριο</label>
                </div>
                <p>Περιγραφή:</p>
                <div class="hotel-info-description">
                    <textarea name="hotel-description" id="hotel-description" cols="30" rows="10" onkeyup="check_limit('hotel-description',2000,'chars_left_counter');"><?php if (isset($DESCRIPTION)) {
    echo $DESCRIPTION;
}?></textarea>
                    <p id="chars_left_counter">Μέχρι, ως 2000 χαρακτήρες.</p>
                </div>
            </div>
            <input type="submit" value="Καταχώρηση στοιχείων" style="margin-top:30px;">
            <p class="tip">Tip: Μπορείτε μετα την προσθήκη της επιχείρησης σας, να επιστρέψετε και να διορθώσετε τα
                στοιχεία
                της σε
                περίπτωση λάθους.</p>
        </form>
    </div>
</main>

<?php require 'footer.php';?>