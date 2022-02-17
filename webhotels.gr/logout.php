<?php
session_start();
session_destroy(); //καταστροφή session
header("Location: index.php?msg=Επιτυχής Αποσύνδεση!");
exit();
