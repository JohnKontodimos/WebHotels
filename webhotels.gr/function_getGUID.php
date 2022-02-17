<?php
function getGUID() //function συμβατότητας για το GUID

{
    if (function_exists('com_create_guid')) { //εαν υπάρχει η συνάρτηση
        return com_create_guid();
    } else {
        mt_srand((double) microtime() * 10000); //εαν δεν υπάρχει δημιούργια guid χειροκίνητα
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = chr(123)
        . substr($charid, 0, 8) . $hyphen
        . substr($charid, 8, 4) . $hyphen
        . substr($charid, 12, 4) . $hyphen
        . substr($charid, 16, 4) . $hyphen
        . substr($charid, 20, 12)
        . chr(125);
        return $uuid;
    }
}
