
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
    <?php
// On récupère les étudiants avec le nom de leur filière
$sql = "SELECT etudiants.*, filieres.nom AS nom_filiere 
        FROM etudiants 
        JOIN filieres ON etudiants.filiere_id = filieres.id";
$queryEtudiants = $pdo->query($sql);
$etudiants = $queryEtudiants->fetchAll();
?>

<hr> <!-- Une ligne de séparation -->

<h3>Liste des Étudiants</h3>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Filière</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= htmlspecialchars($etudiant['nom_filiere']) ?></td>
                <td>
                    <a href="modifier.php?id=<?= $etudiant['id'] ?>" class="btn-edit">Modifier</a>
                    <a href="supprimer.php?id=<?= $etudiant['id'] ?>" class="btn-delete" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</html>
