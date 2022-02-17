<?php
session_start(); //αρχικοποίηση session
$title = "Webhotels-Αρχική"; //δυναμικός τίτλος σελίδας
if (!isset($_SESSION['username'])) {
    require 'header_global.php'; //έλενχος εάν ο χρήστης είναι διαπιστευμένος
} else { //για την προβολή του κατάληλου μενού
    require 'header_logged_in.php';
}
require 'db_params.php'; //παράμετροι και σύνδεση στο database
require 'db_connect.php';

?>
<main>
    <p>Βρείτε προσφορές για ξενοδοχεία,σε διάφορους προορισμούς στην Ελλάδα</p>
    <form action="con_search.php" method="GET" onsubmit="return validate_search()">
        <div class="searchcontainer">
            <div class="search_dest">
                <select name="search_dest" id="search_dest">
                        <option value="0" disabled selected hidden>Προορισμός</option>
                        <option value="Θεσσαλονίκη">Θεσσαλονίκη</option>
                        <option value="Αθήνα">Αθήνα</option>
                        <option value="Σαντορίνη">Σαντορίνη</option>
                </select>
            </div>
            <div class="search_state">
                <select name="search_state" id="search_state">
                        <option value="0" disabled selected hidden>Νομός</option>
                        <option value="Θεσσαλονίκης">Θεσσαλονίκης</option>
                        <option value="Αττικής">Αττικής</option>
                        <option value="Κυκλάδων">Κυκλάδων</option>
                </select>
            </div>
            <div class="search_stars">
                    <select name="search_stars" id="search_stars">
                        <option value="0" disabled selected hidden>Αστέρια</option>
                        <option value="1">1 Αστέρι</option>
                        <option value="2">2 Αστέρων</option>
                        <option value="3">3 Αστέρων</option>
                        <option value="4">4 Αστέρων</option>
                        <option value="5">5 Αστέρων</option>
                    </select>
                </div>
            <div class="noofrooms">
                <select name="noofrooms" id="noofrooms">
                    <option value="0" disabled selected hidden>Αριθμός Ατόμων-Δωματίων</option>
                    <option value="rooms_opt_1">1 ενήλικας 1 δωμάτιο</option>
                    <option value="rooms_opt_2">2 ενήλικες 1 δωμάτιο</option>
                    <option value="rooms_opt_3">2 ενήλικες 1 παιδί 1 δωμάτιο</option>
                    <option value="rooms_opt_4">2 ενήλικες 2 παιδιά 1 δωμάτιο</option>
                    <option value="rooms_opt_5">2 ενήλικες 2 παιδιά 2 δωμάτια</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Αναζήτηση" class="indexsearchbutton">
        </div>
    </form>
    <div class="container">
        <p class="dest">Δημοφιλής προορισμοί στην Ελλάδα</p>
        <div class="indexdestinationcontainer">
            <div>
                <img src="img/thessaloniki.jpg" alt="thessaloniki-image" class="dest_image">
                <a href="con_search.php?search_dest=Θεσσαλονίκη" class="dest_name">Θεσσαλονίκη</a>
            </div>
            <div>
                <img src="img/athens.jpg" alt="athens-image" class="dest_image">
                <a href="con_search.php?search_dest=Αθήνα" class="dest_name">Αθήνα</a>
            </div>
            <div>
                <img src="img/santorini.jpg" alt="santorini-image" class="dest_image">
                <a href="con_search.php?search_dest=Σαντορίνη" class="dest_name">Σαντορίνη</a>
            </div>
            <div>
                <img src="img/rodos.jpg" alt="rodos-image" class="dest_image">
                <a href="con_search.php?search_dest=Ρόδος" class="dest_name">Ρόδος</a>
            </div>
            <div>
                <img src="img/chania.jpg" alt="chania-image" class="dest_image">
                <a href="con_search.php?search_dest=Χανιά" class="dest_name">Χανιά</a>
            </div>
            <div>
                <img src="img/mykonos.jpg" alt="mykonos-image" class="dest_image">
                <a href="con_search.php?search_dest=Μύκονος" class="dest_name">Μύκονος</a>
            </div>
        </div>
    </div>
</main>
<?php
require 'footer.php';
?>