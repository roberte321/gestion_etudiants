<?php
$host = "localhost";
$dbname = "gestion_etudiants";
$user = "root";
$pass = "";

try {
    $PDO = new PDO('mysql:host=localhost;dbname=gestion_etudiants','root','');
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>