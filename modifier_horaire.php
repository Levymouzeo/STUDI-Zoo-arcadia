<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer l'horaire actuel
    $sql = "SELECT * FROM horaire WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $horaire = $stmt->fetch();
}

// Mettre à jour l'horaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jour = $_POST['jour'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];

    $sql = "UPDATE horaire SET jour = ?, heure_debut = ?, heure_fin = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$jour, $heure_debut, $heure_fin, $id]);

    echo "✅ Horaire modifié avec succès !";
    header("Location: liste_horaires.php");
    exit();
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
    }

    label {
        margin-top: 10px;
    }

    input, select {
        margin-top: 5px;
        padding: 5px;
    }

    button {
        margin-top: 10px;
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
<form method="POST">
    <label>Jour :</label>
    <select name="jour" required>
        <option value="Lundi" <?= $horaire['jour'] == 'Lundi' ? 'selected' : '' ?>>Lundi</option>
        <option value="Mardi" <?= $horaire['jour'] == 'Mardi' ? 'selected' : '' ?>>Mardi</option>
        <option value="Mercredi" <?= $horaire['jour'] == 'Mercredi' ? 'selected' : '' ?>>Mercredi</option>
        <option value="Jeudi" <?= $horaire['jour'] == 'Jeudi' ? 'selected' : '' ?>>Jeudi</option>
        <option value="Vendredi" <?= $horaire['jour'] == 'Vendredi' ? 'selected' : '' ?>>Vendredi</option>
        <option value="Samedi" <?= $horaire['jour'] == 'Samedi' ? 'selected' : '' ?>>Samedi</option>
        <option value="Dimanche" <?= $horaire['jour'] == 'Dimanche' ? 'selected' : '' ?>>Dimanche</option>
    </select><br>

    <label>Heure de début :</label>
    <input type="time" name="heure_debut" value="<?= $horaire['heure_debut'] ?>" required><br>

    <label>Heure de fin :</label>
    <input type="time" name="heure_fin" value="<?= $horaire['heure_fin'] ?>" required><br>

    <button type="submit">Modifier</button>
</form>
