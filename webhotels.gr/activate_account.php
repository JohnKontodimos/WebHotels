<?php
$title = 'WebHotels-Ενεργοποίηση Λογαριασμού';
require 'header_global.php';
?>
<!-- ΣΕΛΙΔΑ ΕΝΕΡΓΟΠΟΙΗΣΗΣ ΛΟΓΑΡΙΑΣΜΟΥ -->
<main>
    <div class="activatecontainer">
        <div class="activateform">
            <h2>Ενεργοποίηση λογαριασμού</h2>
            <form method="POST" action="con_activate.php">
                <p>Όνομα Χρήστη/Username:</p>
                <input type=" text" name="username" id="activate_username"required>
                <!-- με την required ο browser ελένχει για εμένα εάν είναι κενά τα inputs -->
                <p>Κωδικός πρόσβασης/Password:</p>
                <input type="password" name="password" required>
                <br>
                <br>
                <p>Κωδικός Ενεργοποίησης:</p>
                <input type="text" name="activate_key" required>
                <br>
                <br>
                <br>
                <input type="submit" name="activate" value="Ενεργοποίηση Λογαριασμού">
                <br>
                <br>
                <br>
            </form>
        </div>
    </div>
</main>
<?php require 'footer.php'?>