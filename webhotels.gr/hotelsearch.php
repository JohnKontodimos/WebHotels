<?php
session_start();
$query = $_SESSION['query'];
$pages = $_SESSION['pages'];
$title = 'WebHotels-Αναζήτηση';
if (!isset($_SESSION['username'])) {
    require 'header_global.php';
} else {
    require 'header_logged_in.php';
}
require 'db_params.php'; //παράμετροι και σύνδεση στο database
require 'db_connect.php';
$recordsPerPage = 4;
if (isset($_GET['page'])) //αν υπάρχει παράμετρος στο URL
{
    $curPage = $_GET['page'];
}
//τότε ότι λέει η παράμετρος
else //διαφορετικά είναι η πρώτη σελίδα
{
    $curPage = 1;
}
//Υπολόγισε τον δείκτη της πρώτης από τις εγγραφές που θέλουμε
$startIndex = ($curPage - 1) * $recordsPerPage;
?>
<main style="padding-top: 70px;height:1300px;">
    <h2 class="search">Αποτελέσματα Αναζήτησης</h2>
    <ul class="searchresults">
<?php
try {
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE $query LIMIT $startIndex,$recordsPerPage"); //ετοιμασία sql ερωτήματος
    $sql->execute();
    while ($record = $sql->fetch(PDO::FETCH_ASSOC)) { //while-loop εύρεσης στοιχείων ξενοδοχείου
        $title_hotel = $record["TITLE"];
        $hotel_addr = $record["ADDRESS"];
        $hotel_dest = $record['DESTINATION'];
        $hotel_state = $record['STATE'];
        $hotel_stars = $record['STARS'];
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
        echo '<li>
            <div class="hotel">
                <div class="hotel-result-img">';
        try {
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_TITLE=:hotels_TITLE"); //ετοιμασία sql ερωτήματος για την εύρεση εικόνας
            $sql->execute(array(':hotels_TITLE' => $title_hotel)); //θελουμε την εικόνα για κάθε ξενοδοχείο και το περναμε σαν παράμετρο
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
        //εμφάνιση στοιχείων με χρήση echo
        echo "<img src='img/hotelimages/$img_src' alt='$img_caption'>";
        echo '</div>
                <div class="hotel-search-small-details">
                    <div class="hotel-search-container">
                        <div class="hotel-search-addr-stars">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>$title_hotel</a>"; //τίτλος ξενοδοχείου
        //ο τίτλος ειναι και link προς την σελίδα προβολής λεπτομερειών
        echo "<div class='no-of-stars'>"?><?php for ($i = 1; $i <= $hotel_stars; $i += 1) {echo "<img src='img/star-icon.jpg' alt='#'>";}?>
        <?php
echo '</div>';
        echo '</div>';
        echo "<div class='search-address'><p>$hotel_addr,</p><p>$hotel_dest,</p><p> Νομός $hotel_state</p></div>";
        echo '<ul class="hotel-search-facilities">';
        //εμφάνιση παροχών(εαν υπάρχουν πέρνουν τιμή true)
        if ($hotel_parking == 'true') {
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
        echo '</div>
                    <div class="more-button">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>Δείτε Τιμές</a>";
        //link που οδηγεί στην σελίδα προβολής λεπτομεριών του ξενοδοχείου
        echo '</div>
                </div>
            </div>
        </li>';
    }
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Εύρεσης Ξενοδοχείου: " . $e->getMessage();
    die();
}
try {
    $startIndex += 1; //εμφάνιση στοιχείων του αμέσως επόμενου ξενοδοχείου(εαν δεν υπάρχει δεν θα εμφανιστεί τίποτα)
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE $query LIMIT $startIndex,$recordsPerPage"); //ετοιμασία sql ερωτήματος για την εύρεση στοιχείων ξενοδοχείου
    $sql->execute();
    while ($record = $sql->fetch(PDO::FETCH_ASSOC)) { //while-loop εύρεσης στοιχείων ξενοδοχείου
        $title_hotel = $record["TITLE"];
        $hotel_addr = $record["ADDRESS"];
        $hotel_dest = $record['DESTINATION'];
        $hotel_state = $record['STATE'];
        $hotel_stars = $record['STARS'];
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
        echo '<li>
            <div class="hotel">
                <div class="hotel-result-img">';
        try {
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_TITLE=:hotels_TITLE"); //ετοιμασία sql ερωτήματος για την εύρεση εικόνας
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
        //εμφάνιση στοιχείων με χρήση echo
        echo "<img src='img/hotelimages/$img_src' alt='$img_caption'>";
        echo '</div>
                <div class="hotel-search-small-details">
                    <div class="hotel-search-container">
                        <div class="hotel-search-addr-stars">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>$title_hotel</a>"; //τιτλος ξενοδοχείου
        //ο τίτλος ειναι και link προς την σελίδα προβολής λεπτομερειών
        echo "<div class='no-of-stars'>" ?><?php for ($i = 1; $i <= $hotel_stars; $i += 1) {echo "<img src='img/star-icon.jpg' alt='#'>";}?>
        <?php
echo '</div>';
        echo '</div>';
        echo "<div class='search-address'><p>$hotel_addr,</p><p>$hotel_dest,</p><p> Νομός $hotel_state</p></div>";
        echo '<ul class="hotel-search-facilities">';
        //εμφάνιση παροχών(εαν υπάρχουν πέρνουν τιμή true)
        if ($hotel_parking == 'true') {
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
        echo '</div>
                    <div class="more-button">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>Δείτε Τιμές</a>";
        //link που οδηγεί στην σελίδα προβολής λεπτομεριών του ξενοδοχείου
        echo '</div>
                </div>
            </div>
        </li>';
    }
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Εύρεσης Ξενοδοχείου: " . $e->getMessage();
    die();
}
try {
    $startIndex += 1; //εμφάνιση στοιχείων του αμέσως επόμενου ξενοδοχείου(εαν δεν υπάρχει δεν θα εμφανιστεί τίποτα)
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE $query LIMIT $startIndex,$recordsPerPage"); //ετοιμασία sql ερωτήματος για την εύρεση στοιχείων ξενοδοχείου
    $sql->execute();
    while ($record = $sql->fetch(PDO::FETCH_ASSOC)) { //while-loop εύρεσης στοιχείων ξενοδοχείου
        $title_hotel = $record["TITLE"];
        $hotel_addr = $record["ADDRESS"];
        $hotel_dest = $record['DESTINATION'];
        $hotel_state = $record['STATE'];
        $hotel_stars = $record['STARS'];
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
        echo '<li>
            <div class="hotel">
                <div class="hotel-result-img">';
        try {
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_TITLE=:hotels_TITLE"); //ετοιμασία sql ερωτήματος για την εύρεση εικόνας
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
        //εμφάνιση στοιχείων με χρήση echo
        echo "<img src='img/hotelimages/$img_src' alt='$img_caption'>";
        echo '</div>
                <div class="hotel-search-small-details">
                    <div class="hotel-search-container">
                        <div class="hotel-search-addr-stars">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>$title_hotel</a>"; //τιτλος ξενοδοχείου
        //ο τίτλος ειναι και link προς την σελίδα προβολής λεπτομερειών
        echo "<div class='no-of-stars'>" ?><?php for ($i = 1; $i <= $hotel_stars; $i += 1) {echo "<img src='img/star-icon.jpg' alt='#'>";}?>
        <?php
echo '</div>';
        echo '</div>';
        echo "<div class='search-address'><p>$hotel_addr,</p><p>$hotel_dest,</p><p> Νομός $hotel_state</p></div>";
        echo '<ul class="hotel-search-facilities">';
        //εμφάνιση παροχών(εαν υπάρχουν πέρνουν τιμή true)
        if ($hotel_parking == 'true') {
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
        echo '</div>
                    <div class="more-button">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>Δείτε Τιμές</a>";
        //link που οδηγεί στην σελίδα προβολής λεπτομεριών του ξενοδοχείου
        echo '</div>
                </div>
            </div>
        </li>';
    }
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Εύρεσης Ξενοδοχείου: " . $e->getMessage();
    die();
}
try {
    $startIndex += 1; //εμφάνιση στοιχείων του αμέσως επόμενου ξενοδοχείου(εαν δεν υπάρχει δεν θα εμφανιστεί τίποτα)
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM hotels WHERE $query LIMIT $startIndex,$recordsPerPage"); //ετοιμασία sql ερωτήματος για την εύρεση στοιχείων ξενοδοχείου
    $sql->execute();
    while ($record = $sql->fetch(PDO::FETCH_ASSOC)) { //while-loop εύρεσης στοιχείων ξενοδοχείου
        $title_hotel = $record["TITLE"];
        $hotel_addr = $record["ADDRESS"];
        $hotel_dest = $record['DESTINATION'];
        $hotel_state = $record['STATE'];
        $hotel_stars = $record['STARS'];
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
        echo '<li>
            <div class="hotel">
                <div class="hotel-result-img">';
        try {
            $pdo = getDB(); //function για σύνδεση στο database
            $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_TITLE=:hotels_TITLE"); //ετοιμασία sql ερωτήματος για την εύρεση εικόνας
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
        //εμφάνιση στοιχείων με χρήση echo
        echo "<img src='img/hotelimages/$img_src' alt='$img_caption'>";
        echo '</div>
                <div class="hotel-search-small-details">
                    <div class="hotel-search-container">
                        <div class="hotel-search-addr-stars">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>$title_hotel</a>"; //τιτλος ξενοδοχείου
        //ο τίτλος ειναι και link προς την σελίδα προβολής λεπτομερειών
        echo "<div class='no-of-stars'>" ?><?php for ($i = 1; $i <= $hotel_stars; $i += 1) {echo "<img src='img/star-icon.jpg' alt='#'>";}?>
        <?php
echo '</div>';
        echo '</div>';
        echo "<div class='search-address'><p>$hotel_addr,</p><p>$hotel_dest,</p><p> Νομός $hotel_state</p></div>";
        echo '<ul class="hotel-search-facilities">';
        //εμφάνιση παροχών(εαν υπάρχουν πέρνουν τιμή true)
        if ($hotel_parking == 'true') {
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
        echo '</div>
                    <div class="more-button">';
        echo "<a href='hoteldetails.php?hotel=$title_hotel'>Δείτε Τιμές</a>";
        //link που οδηγεί στην σελίδα προβολής λεπτομεριών του ξενοδοχείου
        echo '</div>
                </div>
            </div>
        </li>';
    }
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Εύρεσης Ξενοδοχείου: " . $e->getMessage();
    die();
}

?>
    </ul>
    <br>
    <p class="search_pages">
    <?php //τώρα θα τυπώσουμε τους συνδέσμους πλοήγησης στις σελίδες
for ($i = 1; $i <= $pages; $i++) {
    // εάν δεν είναι η τρέχουσα σελίδα, φτιάξε link
    if ($i != $curPage) {?>
             <a href="hotelsearch.php?page=<?php echo $i; ?>"><?php echo $i ?></a>
        <?php // αν είναι η τρέχουσα σελίδα, τύπωσε απλά τον αριθμό της
    } else {?>
        <a href="#" class="selected_page"><?php echo $i ?></a>
       <?php
}
}?>
    </p>
</main>
<br>
<br>
<br>
<br>
<br>
<?php require 'footer.php'?>