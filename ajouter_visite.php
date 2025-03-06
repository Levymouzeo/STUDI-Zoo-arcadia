<?php
include 'config.php';

// Récupérer les animaux
$sql = "SELECT * FROM animal";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

// Récupérer les vétérinaires
$sql = "SELECT * FROM veterinaire";
$stmt = $pdo->query($sql);
$veterinaires = $stmt->fetchAll();

// Ajouter une visite
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $veterinaire_id = $_POST['veterinaire_id'];
    $date_visite = $_POST['date_visite'];
    $observations = $_POST['observations'];

    $sql = "INSERT INTO visite_medicale (animal_id, veterinaire_id, date_visite, observations) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animal_id, $veterinaire_id, $date_visite, $observations]);

    echo "✅ Visite médicale enregistrée avec succès !";
}
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    label {
        margin-top: 10px;
    }

    input, select, textarea {
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
    <label>Animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>"><?= $a['nom'] ?> (<?= $a['race'] ?>)</option>
        <?php endforeach; ?>
    </select><br>

    <label>Vétérinaire :</label>
    <select name="veterinaire_id" required>
        <?php foreach ($veterinaires as $v) : ?>
            <option value="<?= $v['id'] ?>"><?= $v['nom'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Date de la visite :</label>
    <input type="date" name="date_visite" required><br>

    <label>Observations :</label>
    <textarea name="observations" required></textarea><br>

    <button type="submit">Ajouter Visite</button>
</form>
