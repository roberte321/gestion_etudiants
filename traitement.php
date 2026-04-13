<?php
// 1. Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');

// 2. On vérifie si le formulaire a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 3. Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    // 4. Vérification que les champs ne sont pas vides
    if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
        
        // 5. Préparation de la requête d'insertion
        $stmt = $db->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
        
        // 6. Exécution avec les données
        $stmt->execute([$nom, $prenom, $filiere_id]);
    }
}

// 7. Retour automatique à la page d'accueil pour voir le résultat
header('Location: index.php');
exit();
