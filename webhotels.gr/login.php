<?php
session_start(); //αρχικοποίηση session
$title = "Webhotels-Σύνδεση"; //δυναμικός τίτλος σελίδας
require 'login_header.php';
if (isset($_SESSION['username'])) { //έλενχος εάν ο χρήστης είναι ήδη συνδεμένος
    header("Location: index.php?msg=Είσαι ήδη συνδεμένος! Πάτα Αποσύνδεση εάν θέλεις να συνδεθείς σε άλλο λογαριασμό");
}?>
<main>
    <div class="loginbackroundcontainer">
    <div class="loginformcontainer">
        <div class="loginform">
                <h2>Συνδεθείτε στον λογαριασμό σας</h2>
                <form method="POST" action="con_login.php">
                    <p>Όνομα Χρήστη/Username:</p>
                    <input type="text" name="username" required>
                    <!-- με την required ο browser ελένχει για εμένα εάν είναι κενά τα inputs -->
                    <p>Κωδικός πρόσβασης/Password:</p>
                    <input type="password" name="password" required>
                    <br>
                    <br>
                    <br>
                    <input type="submit" name="login" value="Σύνδεση">
                    <br>
                    <br>
                    <div class="loginlinks">Δεν έχετε λογαριασμό;&nbsp;&nbsp;<a href="register.php">Εγγραφή</a></div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require 'footer.php'?>