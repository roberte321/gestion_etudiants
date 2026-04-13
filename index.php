
<?php 
require_once 'db_connect.php'; // Ton fichier de connexion PDO

// Récupération des filières
$query = $pdo->query("SELECT * FROM filieres");
$filieres = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Gestion Étudiants</title>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Étudiant</h2>
        <form id="studentForm" action="traitement.php" method="POST">
            <input type="text" name="nom" id="nom" placeholder="Nom">
            <input type="text" name="prenom" id="prenom" placeholder="Prénom">
            
            <select name="filiere_id" id="filiere">
                <option value="">-- Choisir une filière --</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id'] ?>"><?= $filiere['nom'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Enregistrer</button>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
