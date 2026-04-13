<?php
// 1. Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');

// 2. On récupère l'ID de l'étudiant via l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Requête de suppression sécurisée
    $stmt = $db->prepare("DELETE FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
}

// 4. Redirection vers l'accueil pour voir que l'étudiant a disparu
header('Location: index.php');
exit();
?>
