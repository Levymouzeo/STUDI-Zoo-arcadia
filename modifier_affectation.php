<?php
include 'config.php';

// Récupérer les animaux qui ont déjà un habitat
$sql = "SELECT animal.id, animal.nom, animal.race, habitat.nom AS habitat_nom, habitat.id AS habitat_id 
        FROM animal 
        INNER JOIN habitat ON animal.habitat_id = habitat.id";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

// Récupérer la liste des habitats disponibles
$sql = "SELECT * FROM habitat";
$stmt = $pdo->query($sql);
$habitats = $stmt->fetchAll();

// Vérifier si un formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST['animal_id'];
    $nouveau_habitat_id = $_POST['habitat_id'];

    // Mise à jour de l'habitat de l'animal
    $sql = "UPDATE animal SET habitat_id = :habitat_id WHERE id = :animal_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':habitat_id' => $nouveau_habitat_id,
        ':animal_id' => $animal_id
    ]);

    echo "✅ L'animal a été réaffecté avec succès !";
}

?>


<h2>Modifier l'affectation d'un animal</h2>
<style>
    select {
        width: 200px;
        padding: 5px;
        margin: 5px 0;
    }

    button {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
<form method="POST">
    <label>Choisir un animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>">
                <?= $a['nom'] ?> (<?= $a['race'] ?>) - Actuellement dans : <?= $a['habitat_nom'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Choisir un nouvel habitat :</label>
    <select name="habitat_id" required>
        <?php foreach ($habitats as $h) : ?>
            <option value="<?= $h['id'] ?>"><?= $h['nom'] ?> (<?= $h['description'] ?>)</option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Modifier l'affectation</button>
</form>
