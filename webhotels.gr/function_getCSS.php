<?php
function getCSS()
{
    //αν δεν υπάρχει σχετικό cookie, τότε ο χρήστης
    //ΔΕΝ έχει επιλέξει - δώσε το default (δηλ. το light.css)
    if (!isset($_COOKIE['css'])) {
        $css = 'light.css';
    } else
    //αλλιώς δώσε ότι λέει το cookie
    {
        $css = $_COOKIE['css'];
    }
    //επέστρεψε το αποτέλεσμα
    return $css;
}
