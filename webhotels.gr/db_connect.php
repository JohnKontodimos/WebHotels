<?php
session_start(); //δημιουργία session
function getDB() //function συνδεσης στο database
{
    require('db_params.php'); //παράμετροι σύνδεσης στην database
    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); //δημιουργία pdo object
        $pdo->exec("set names utf8"); // εφαρμογή σωστής κωδικοποίησης για ελληνικά
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) { //χειρισμός PDO Exception
        echo 'Αποτυχία σύνδεσης στο database: ' . $e->getMessage();
        die();
    }
}
