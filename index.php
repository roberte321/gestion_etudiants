<?php 
$db = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');

// 1. Récupérer les filières pour le formulaire
$queryFil = $db->query("SELECT * FROM filieres");
$filieres = $queryFil->fetchAll();

// 2. Récupérer les étudiants pour le tableau (AJOUTE CECI)
$queryEtud = $db->query("SELECT etudiants.*, filieres.nom AS nom_filiere FROM etudiants JOIN filieres ON etudiants.filiere_id = filieres.id");
$etudiants = $queryEtud->fetchAll();
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
    <script src="script.js"></script>
</body>
    <?php
// On récupère les étudiants avec le nom de leur filière
$sql = "SELECT etudiants.*, filieres.nom AS nom_filiere 
        FROM etudiants 
        JOIN filieres ON etudiants.filiere_id = filieres.id";
$queryEtudiants = $db->query($sql);
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
            <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
            <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
            <td><?php echo htmlspecialchars($etudiant['nom_filiere']); ?></td>
            <td>
                <!-- Liens vers modifier et supprimer -->
                <a href="modifier.php?id=<?= $etudiant['id'] ?>" class="btn-edit">Modifier</a>
                <a href="supprimer.php?id=<?= $etudiant['id'] ?>" class="btn-delete" onclick="return confirm('Sûr ?')">Supprimer</a>


            </td>
        </tr>
        <?php endforeach; ?>
            </tbody>
    </table>
</html>
