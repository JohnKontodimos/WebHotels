<footer>
    <div class="footerlinks">
        <img src="img/facebook-icon.jpg" alt="facebook-icon" class="facebook">
        <img src="img/instagram-icon.jpg" alt="instagram-icon" class="instagram">
        <img src="img/twitter-icon.jpg" alt="twitter-icon" class="twitter">
        <a href="#">Επικοινωνία</a>
        <a href="#">Όροι & προϋποθέσεις</a>
        <a href="#">Πολιτική Απορρήτου</a>
        <?php
//λήψη προτοκόλου που χρησιμοποιείται στο url
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//λήψη url
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//αποστολή url στο link αλλαγής θέματος έτσι ώστε να μπορεί ο χρήστης να παραμείνει στην ίδια σελίδα
//και απλά να γίνει αλλαγή της εμφάνισης της(refresh της τρέχουσας σελίδας)
if ($style == 'light.css') { //αλλαγή link και εικονιδίου ανάλογα με το επιλεγμένο θέμα
    echo "<a href='store_css.php?style=dark&url=$url'>Αλλαγή Θέματος<img src='img/theme-light.jpg' alt='theme-icon' class='theme'></a>";
} else {
    echo "<a href='store_css.php?style=light&url=$url'>Αλλαγή Θέματος<img src='img/theme-dark.jpg' alt='theme-icon' class='theme'></a>";
}
?>
    </div>
</footer>
<?php
require 'function_alert.php'; //συνάρτηση ειδοποιήσης του χρήστη με alert box
if ($msg != "") {
    function_alert($msg);
}
?>
</body>
</html>