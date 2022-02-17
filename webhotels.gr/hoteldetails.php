<?php
//ΣΕΛΙΔΑ ΠΡΟΒΟΛΗΣ ΛΕΠΤΟΜΕΡΙΩΝ ΕΝΟΣ ΞΕΝΟΔΟΧΕΙΟΥ
require 'db_params.php'; //παράμετροι και σύνδεση στο database
require 'db_connect.php';
$title = $_GET['hotel']; //λήψη τίτλου από το url
if (!isset($_SESSION['username'])) { //έλενχος εαν είναι συνδεμένος ο χρήστης
    require 'header_global.php';
} else {
    require 'header_logged_in.php';
}
?>
<main style="margin-top: 80px;height: 2000px;">
<?php try { //λήψη στοιχείων ξενοδοχείου χρησιμοποιόντας τον τίτλο από το url
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE TITLE='$title'"); //ετοιμασία sql ερωτήματος για την εύρεση στοιχείων ξενοδοχείου
    $sql->execute();
    while ($record = $sql->fetch(PDO::FETCH_ASSOC)) { //while-loop στοιχείων ξενοδοχείου
        $title_hotel = $record["TITLE"];
        $hotel_addr = $record["ADDRESS"];
        $hotel_dest = $record['DESTINATION'];
        $hotel_state = $record['STATE'];
        $hotel_stars = $record['STARS'];
        $hotel_phone = $record['PHONE'];
        $hotel_desc = $record['DESCRIPTION'];
        $hotel_rooms_opt_1 = $record['rooms_opt_1'];
        $hotel_rooms_opt_2 = $record['rooms_opt_2'];
        $hotel_rooms_opt_3 = $record['rooms_opt_3'];
        $hotel_rooms_opt_4 = $record['rooms_opt_4'];
        $hotel_rooms_opt_5 = $record['rooms_opt_5'];
        $hotel_parking = $record['parking'];
        $hotel_wifi = $record['wifi'];
        $hotel_bar = $record['bar'];
        $hotel_restaurant = $record['restaurant'];
        $hotel_room_service = $record['room_service'];
        $hotel_24_hours_reception = $record['24_hours_reception'];
        $hotel_pets = $record['pets'];
        $hotel_pool = $record['pool'];
        $hotel_ac = $record['ac'];
        $hotel_gym = $record['gym'];
        try { //εύρεση της εικόνας του κάθε ξενοδοχείου
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_TITLE=:hotels_TITLE"); //ετοιμασία sql ερωτήματος
            $sql->execute(array(':hotels_TITLE' => $title_hotel)); //θελουμε την εικόνα για καθε ξενοδοχείο και το περναμε σαν παράμετρο
            while ($record = $sql->fetch()) {
                $img_src = $record['idimages'] . '.jpg';
                $img_caption = $record['image_caption'];
            }
            $sql->closeCursor(); //Απελευθέρωση πόρων στον server
            $pdo = null;
        } catch (PDOException $e) { //χειρισμός PFO Exception
            print "Πρόβλημα Εύρεσης Εικόνας: " . $e->getMessage();
            die();
        }
        //εμφάνιση της κάθε πληροφορίας αναλόγα με το κάθε ξενοδοχείο
        echo '<div class="hotel-details-container">
            <div class="hotel-details-title-container">
                <div class="hotel-details-title">';
        echo "<p>$title_hotel</p>";
        echo '</div>
                <div class="hotel-details-stars">';?><?php for ($i = 1; $i <= $hotel_stars; $i += 1) {echo "<img src='img/star-icon.jpg' alt='#'>";}?>
        <?php echo '</div>';
        echo '</div>';
        echo "<div class='hotel-details-address'>$hotel_addr, $hotel_dest, Νομός $hotel_state</div>";
        echo '<div class="hotel-details-img">';
        echo "<img src='img/hotelimages/$img_src' alt='$img_caption'>";
        echo "<p class='hoteldetails_caption'>$img_caption</p>";
        echo '</div>';
        echo '<div class="hotel-details-desc">';
        echo "<p>$hotel_desc</p>";
        echo '</div>
            <br>';
        echo '<div class="hotel-details-facilities-container">
                <h3>Οι παροχές μας:</h3>
                <ul class="hotel-details-facilities">';
        if ($hotel_parking == 'true') { //εμφάνιση παροχών εάν έχουν τσεκαριστεί(εχουν true)
            echo '<li><img src="img/parking-icon.jpg" alt="#"><label>Παρκιγκ</label></li>';
        }
        if ($hotel_wifi == 'true') {
            echo '<li><img src="img/wifi-icon.jpg" alt="#"><label>Δωρεάν Wi-Fi Internet</label></li>';
        }
        if ($hotel_bar == 'true') {
            echo '<li><img src="img/bar-icon.jpg" alt="#"><label>Μπαρ</label></li>';
        }
        if ($hotel_restaurant == 'true') {
            echo '<li><img src="img/restaurant-icon.jpg" alt="#"><label>Εστιατόριο</label></li>';
        }
        if ($hotel_room_service == 'true') {
            echo '<li><img src="img/room-service-icon.jpg" alt="#"><label>Υπηρεσία δωματίου</label></li>';
        }
        if ($hotel_24_hours_reception == 'true') {
            echo '<li><img src="img/24-hours-reception-icon.jpg" alt="#"><label>24ωρη Ρεσεψιόν</label></li>';
        }
        if ($hotel_pets == 'true') {
            echo '<li><img src="img/pets-icon.jpg" alt="#"><label>Kατοικίδια</label></li>';
        }
        if ($hotel_pool == 'true') {
            echo '<li><img src="img/pool-icon.jpg" alt="#"><label>Πισίνα</label></li>';
        }
        if ($hotel_ac == 'true') {
            echo '<li><img src="img/air-conditioner-icon.jpg" alt="#"><label>Κλιματισμός';
        }
        if ($hotel_gym == 'true') {
            echo '<li><img src="img/gym-icon.jpg" alt="#"><label>Γυμναστήριο</label></li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '<br>
            <table class="hotel-details-rooms"><th colspan="2">Διαθέσιμα Δωμάτια:</th>';
        if ($hotel_rooms_opt_1 == 'true') { //εμφάνιση δωματίων εάν έχουν τσεκαριστεί(εχουν true)
            echo '<tr class="opt1"><td><img src="img/person-icon.jpg" alt="#"></td><td>1 ενήλικας 1 δωμάτιο</td></tr>';
        }
        if ($hotel_rooms_opt_2 == 'true') {
            echo '<tr class="opt2"><td><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/person-icon.jpg" alt="#"></td><td>2 ενήλικες 1 δωμάτιο</td></tr>';
        }
        if ($hotel_rooms_opt_3 == 'true') {
            echo '<tr class="opt3"><td><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/child-icon.jpg" alt="#"></td><td>2 ενήλικες 1 παιδί 1 δωμάτιο</td></tr>';
        }
        if ($hotel_rooms_opt_4 == 'true') {
            echo '<tr class="opt4"><td><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/child-icon.jpg" alt="#"><span>+</span><img src="img/child-icon.jpg" alt="#"></td><td>2 ενήλικες 2 παιδιά 1 δωμάτιο</td></tr>';
        }
        if ($hotel_rooms_opt_5 == 'true') {
            echo '<tr class="opt5"><td><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/person-icon.jpg" alt="#"><span>+</span><img src="img/child-icon.jpg" alt="#"><span>+</span><img src="img/child-icon.jpg" alt="#"></td><td>2 ενήλικες 2 παιδιά 2 δωμάτια</td></tr>';
        }
        echo '</table>
            <br>
            <button class="hotel-details-btn">Κάντε Κράτηση</button>
            <br>
            <div class="hotel-details-phone">';
        echo "<p>Εξυπηρέτηση Πελατών:&nbsp;<span>$hotel_phone</span></p>";
        echo '</div>
        </div>';
        echo '</main>';
    }
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Εύρεσης Ξενοδοχείου: " . $e->getMessage();
    die();
} ?>

<?php require 'footer.php'?>
