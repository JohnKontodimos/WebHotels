<?php
session_start(); //αρχικοποίηση session
$title = "Webhotels-Εγγραφή"; //δυναμικός τίτλος σελίδας
require 'register_header.php';
if (isset($_SESSION['username'])) { //έλενχος εάν ο χρήστης είναι ήδη συνδεμένος
    header("Location: index.php?msg=Είσαι ήδη συνδεμένος! Πάτα Αποσύνδεση εάν θέλεις να δημιουργήσεις άλλο λογαριασμό");
}?>
<main>
    <div class="registerbackroundcontainer">
        <div class="registerformcontainer">
            <div class="registerform">
                <h2>Δημιουργήστε τον λογαριασμό σας</h2>
                <form id="registerform" name="registerform" action="con_register.php" method="POST" onsubmit="return validate_form();">
                    <p>Όνομα Χρήστη/Username:</p>
                    <input type="text" name="username" id="username" onkeyup="AJAXcallusername()" required>
                    <div class="error" id="register_username_error"></div>
                    <p>Διεύθυνση ηλ. ταχ./Email:</p>
                    <input type="text" name="email" id="email" onkeyup="AJAXcallemail()" required>
                    <div class="error" id="register_email_error"></div>
                    <p>Κωδικός πρόσβασης/Password:</p>
                    <input type="password" name="password" id="password" required>
                    <div class="error" id="register_password_error"></div>
                    <br>
                    <!-- με την required ο browser ελένχει για εμένα εάν είναι κενά τα inputs -->
                    <!-- ενσωμάτωση captcha συμφωνα με το documentation της google -->
                    <div class="g-recaptchacontainer">
                    <!-- αλλαγή θέματος captcha συμφωνα με την $style από το getCSS -->
                    <?php if ($style == 'dark.css') {
    echo "<div class='g-recaptcha' data-theme='dark' data-sitekey='6LdB-OAaAAAAADs2p1lCUeGoLsZ5eHKr0b3IfAha'></div>";} else {echo "<div class='g-recaptcha' data-theme='light' data-sitekey='6LdB-OAaAAAAADs2p1lCUeGoLsZ5eHKr0b3IfAha'></div>";
}?>

                    </div>
                    <br>
                    <input type="submit" name="register" value="Δημιουργία Λογαριασμού">
                    <br>
                    <br>
                    <div class="registerlinks">Έχετε ήδη λογαριασμό;&nbsp;&nbsp;<a href="login.php">Σύνδεση</a></div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require 'footer.php'?>