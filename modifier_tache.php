<?php
include 'config.php'; // Connexion à la base de données

// Vérifier si une tâche est sélectionnée pour la modification
if (!isset($_GET['id'])) {
    die("❌ Erreur : Aucune tâche sélectionnée.");
}

$tache_id = $_GET['id'];

// Récupérer les détails de la tâche à modifier
$sql = "SELECT * FROM tache WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $tache_id]);
$tache = $stmt->fetch();

if (!$tache) {
    die("❌ Erreur : Tâche introuvable.");
}

// Récupérer la liste des employés pour l'assignation
$sql = "SELECT id, nom, prenom FROM employe";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $date_tache = $_POST['date_tache'];
    $employe_id = $_POST['employe_id'];

    // Mise à jour dans la base de données
    $sql = "UPDATE tache SET description = :description, date_tache = :date_tache, employe_id = :employe_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':description' => $description,
        ':date_tache' => $date_tache,
        ':employe_id' => $employe_id,
        ':id' => $tache_id
    ]);

    echo "✅ Tâche mise à jour avec succès !";
}
?>
<style>
    form {
        margin-top: 20px;
        border: 1px solid #3333;
        padding: 10px;
        width: 300px;
    }

    input,
    select {
        margin: 5px 0;
        padding: 5px;
        width: 100%;
    }

    button {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }
</style>
<h2>Modifier une Tâche</h2>
<form method="POST">
    <label>Description :</label>
    <input type="text" name="description" value="<?= $tache['description'] ?>" required><br>

    <label>Date :</label>
    <input type="date" name="date_tache" value="<?= $tache['date_tache'] ?>" required><br>

    <label>Employé :</label>
    <select name="employe_id" required>
        <?php foreach ($employes as $e) : ?>
            <option value="<?= $e['id'] ?>" <?= ($e['id'] == $tache['employe_id']) ? 'selected' : '' ?>>
                <?= $e['nom'] . " " . $e['prenom'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Modifier</button>
</form>// Path: http://localhost/modifier_tache.php?id=1   
