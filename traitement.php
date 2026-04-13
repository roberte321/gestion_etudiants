<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
        $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $prenom, $filiere_id]);
    }
    
    header('Location: index.php'); // Retour à l'accueil
    exit();
}
