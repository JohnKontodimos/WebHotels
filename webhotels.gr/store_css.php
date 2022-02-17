<?php
//αποθήκευση css σε cookie
if (isset($_GET['style'])) { //εαν υπάρχει η παράμετρος style από το url
    if ($_GET['style'] == 'light') { //φωτεινό θέμα
        $style = 'light.css';
    } elseif ($_GET['style'] == 'dark') { //σκοτεινό θέμα
        $style = 'dark.css';
    } else { //default επιλογή το φωτεινό θέμα
        $style = 'light.css';
    }
    if (isset($_COOKIE['css'])) { //εαν υπάρχει css κάντο κενό
        setcookie('css', '', time() - 3600);
    }
    $expire = time() + 120 * 24 * 60 * 60;
    setcookie('css', $style, $expire); //ορισμός css στο cookie
    if (isset($_GET['url'])) { //λήψη url της εκάστοτε σελίδας που έγινε αλλαγή θέματος
        $url = $_GET['url']; //εαν υπάρχει
    } else {
        $url = "index.php"; //εάν δεν υπάρχει
    }
    header("Location: $url"); //ανακατεύθυνση στο url που λήφθηκε από το link εναλλαγής θέματος
    exit();
} else { //εαν δεν υπάρχει η παράμετρος style
    header("Location:index.php");
    exit();
}
