<?php
include 'config.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "❌ Erreur : Aucun identifiant de repas fourni.";
    exit();
}

$id = $_GET['id'];

// Récupérer les infos du repas
$sql = "SELECT * FROM repas WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$repas = $stmt->fetch();

if (!$repas) {
    echo "❌ Erreur : Repas introuvable.";
    exit();
}

// Récupérer la liste des animaux
$sql = "SELECT id, nom FROM animal";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

// Mettre à jour le repas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $type_nourriture = $_POST['type_nourriture'];
    $quantite = $_POST['quantite'];
    $date_repas = $_POST['date_repas'];

    $sql = "UPDATE repas SET animal_id = ?, type_nourriture = ?, quantite = ?, date_repas = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animal_id, $type_nourriture, $quantite, $date_repas, $id]);

    echo "✅ Repas mis à jour avec succès !";
    header("Location: liste_repas.php");
    exit();
}
?>
<style>
    form {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #3333;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input,
    select {
        padding: 5px;
        width: 100%;
        margin-top: 5px;
    }

    button {
        margin-top: 10px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    a {
        text-decoration: none;
        color: #333;
        margin-top: 10px;
        display: inline-block;
    }
</style>
<!-- Formulaire de modification -->
<h2>Modifier un repas 🍽️</h2>
<form method="POST">
    <label>Animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>" <?= ($a['id'] == $repas['animal_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Type de nourriture :</label>
    <input type="text" name="type_nourriture" value="<?= htmlspecialchars($repas['type_nourriture']) ?>" required><br>

    <label>Quantité (g) :</label>
    <input type="number" name="quantite" value="<?= htmlspecialchars($repas['quantite']) ?>" required><br>

    <label>Date du repas :</label>
    <input type="date" name="date_repas" value="<?= htmlspecialchars($repas['date_repas']) ?>" required><br>

    <button type="submit">Modifier</button>
</form>

<a href="liste_repas.php">🔙 Retour à la liste</a>
