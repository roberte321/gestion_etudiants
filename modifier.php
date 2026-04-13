<?php
// 1. Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_etudiants', 'root', '');

// 2. Récupérer les infos de l'étudiant via l'ID envoyé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    $etudiant = $stmt->fetch();
}

// 3. Traiter la mise à jour quand on clique sur le bouton
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nom, $prenom, $filiere_id, $id]);

    header('Location: index.php'); // Retour à l'accueil après modif
    exit();
}

// Récupérer les filières pour la liste déroulante
$filieres = $db->query("SELECT * FROM filieres")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Modifier Étudiant</title>
</head>
<body>
    <div class="container">
        <h2>Modifier les informations</h2>
        <form action="modifier.php" method="POST">
            <!-- Champ caché pour garder l'ID -->
            <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
            
            <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
            
            <select name="filiere_id" required>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id'] ?>" <?= ($filiere['id'] == $etudiant['filiere_id']) ? 'selected' : '' ?>>
                        <?= $filiere['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Enregistrer les modifications</button>
            <a href="index.php">Annuler</a>
        </form>
    </div>
</body>
</html>
