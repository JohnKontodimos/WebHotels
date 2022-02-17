<?php
session_start();
$title = "WebHotels: Εικόνες Επιχείρησης"; //δυναμικός τίτλος ιστοσελίδας
require 'header_logged_in.php';
if (!isset($_SESSION['username'])) { //έλενχος εάν ο χρήστης δεν είναι συνδεμένος
    header("Location: index.php?msg=Πρέπει να είσαι συνδεδεμένος για την προσθήκη εικόνων της επειχήρησης σου!");
}
$image_mode = ''; //αρχικοποίηση του mode
require 'db_params.php'; //παράμετροι και σύνδεση στο database
require 'db_connect.php';
$username = $_SESSION['username']; //λήψη username από το session
try {
    $pdo = getDB(); //function για σύνδεση στο database
    $sql = $pdo->prepare("SELECT * FROM images WHERE hotels_users_USERNAME=:username"); //ετοιμασία sql ερωτήματος
    $sql->execute(array(':username' => $_SESSION['username']));
    $count = $sql->rowCount(); //κλήση της rowCount() για την μέτρηση των στοιχείων στο database
    $sql->closeCursor(); //Απελευθέρωση πόρων στον server
    $pdo = null;
    if ($count > 0) { //εάν τα στοιχεία που δόθηκαν υπάρχουν στο database
        $image_mode = 'delete'; //κάνε διαγραφή εικόνας
    } else {
        $image_mode = 'insert'; //αλλίως μπορείς να εισάγεις εικόνα
    }
} catch (PDOException $e) { //χειρισμός PFO Exception
    print "Πρόβλημα Database: " . $e->getMessage();
    die("Αδυναμία δημιούργίας PDO Object");
}
if ($image_mode == 'delete') { //εάν γίνεται διαγραφή λήψη της εικόνας και των στοιχείων για προεποσκόπιση
    try {
        $pdo = getDB(); //function για σύνδεση στο database
        $sql = $pdo->prepare("SELECT idimages,image_name,image_caption FROM images WHERE hotels_users_USERNAME=:username"); //ετοιμασία sql ερωτήματος
        $sql->execute(array(':username' => $_SESSION['username']));
        while ($record = $sql->fetch()) { //while-loop εύρεσης στοιχείων
            $image_id = $record['idimages'];
            $image_name = $record['image_name'];
            $image_caption = $record['image_caption'];
        }
        $_SESSION['image_id'] = $image_id; //αποθήκευση του image id στο session για χρήση του στη διαγραφή
        $sql->closeCursor(); //Απελευθέρωση πόρων στον server
        $pdo = null;
    } catch (PDOException $e) { //χειρισμός PFO Exception
        print "Πρόβλημα Database: " . $e->getMessage();
        die("Αδυναμία δημιούργίας PDO Object");
    }
    $img_src = $image_id . '.jpg'; //δημιουργία του ονόματος αρχείου με το extension του
}
$_SESSION['image_mode'] = $image_mode; //αποθήκευση του mode εισαγωγής εικόνων στο session
?>
<main style="height: 1200px;">
        <h1 class="hotel-images">Εικόνα Επιχείρησης</h1>
        <form enctype="multipart/form-data" action="con_images.php" method="post" class="image-upload-form" onsubmit="return validate_images()">
            <div class="img-container">
                <div class="wrapper">
                    <div class="image">
                     <!--ΔΥΝΑΜΙΚΗ ΠΡΟΒΟΛΗ ΣΤΟΙΧΕΙΩΝ ΤΗΣ ΙΣΤΟΣΕΛΙΔΑΣ ΜΕ ΒΑΣΗ ΤΟ MODE ΕΙΣΑΓΩΓΗΣ ΕΙΚΟΝΩΝ  -->
                        <?php if ($image_mode == 'delete') {echo "<img src='img/hotelimages/" . $img_src . "' alt='$image_caption'>";} else {echo "<img id='preview'>";}?>
                    </div>
                    <?php if ($image_mode == 'insert') {echo '<div class="content">
                        <div class="icon"><img src="img/upload-icon.jpg" alt="#"></div>
                        <div class="upload-text">Δεν επιλέχθηκε κάποιο αρχείο!</div>
                    </div>';}?>
                </div>
            </div>
            <?php if ($image_mode == 'insert') {echo '<div class="btn-container">
                <div class="button-wrap">
                    <label class="upload-button" for="file"><img src="img/image-select-icon.jpg" alt="#">Επιλογή Εικόνας</label>
                    <input id="file" name="file" type="file" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="image-upload-desc">
                    <p>Λεζάντα Εικόνας:</p>
                    <input type="text" name="image_caption" id="image_caption" required>
                </div>
            </div>';}?>
            <?php if ($image_mode == 'delete') {echo "<div class='image-caption'>Λεζάντα εικόνας: " . $image_caption . "</div>";}?>
            <?php if ($image_mode == 'delete') {echo '<div class="delete-btn-wrap">
                    <div class="delete-image-btn"><img src="img/delete-icon.jpg" alt="#"><a href="con_images.php">Διαγραφή
                            Εικόνας</a></div>
                </div>';}?>
            <?php if ($image_mode == 'insert') {echo '<div>
                <input type="submit" value="Αποθήκευση Εικόνας" class="save-images">
            </div>';}?>
            <?php echo '<br>'; ?>
            <?php if ($image_mode == 'insert') {echo '<div class="hotel_images_tip">Tip: Μπορείτε να εισάγετε μία είκονα JPG, η οποία θα έχει μέγεθος εως 300KB.</div>
            <div class="hotel_images_tip">Εάν αλλάξετε γνώμη,μπορείτε να επιστρέψετε εδώ και να τη διαγράψετε.</div>
            <div class="hotel_images_tip">Εφόσον γίνει η διαγραφή της εικόνας μπορείτε να εισάγετε μία άλλη.</div>';}?>
            <?php if ($image_mode == 'delete') {echo '<div class="hotel_images_tip">Tip: Έχετε ήδη εισάγει την παραπάνω εικόνα. Εάν θέλετε να εισάγετε μία</div>
            <div class="hotel_images_tip">άλλη εικόνα πρέπει πρώτα να διαγράψετε την παραπάνω.</div>
            <div class="hotel_images_tip">Με τη διαγραφή της εικόνας διαγράφετε και την λεζάντα της.</div>';}?>
        </form>
</main>
<?php require 'footer.php'?>