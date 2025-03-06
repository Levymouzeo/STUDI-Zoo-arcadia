<?php
include 'config.php';

// Récupérer la liste des animaux non affectés
$sql_animaux = "SELECT * FROM animal WHERE habitat_id IS NULL";
$stmt_animaux = $pdo->query($sql_animaux);
$animaux = $stmt_animaux->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des habitats
$sql_habitats = "SELECT * FROM habitat";
$stmt_habitats = $pdo->query($sql_habitats);
$habitats = $stmt_habitats->fetchAll(PDO::FETCH_ASSOC);


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitat_id = $_POST['habitat_id'];
    $animal_id = $_POST['animal_id'];

    $sql = "UPDATE animal SET habitat_id = :habitat_id WHERE id = :animal_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':habitat_id' => $habitat_id,
        ':animal_id' => $animal_id
    ]);

    echo "✅ Animal affecté à l'habitat avec succès !";
}
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<form method="POST">
    <label>Choisir un animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nom']) ?> (<?= htmlspecialchars($a['race']) ?>)</option>
        <?php endforeach; ?>
    </select><br>

    <label>Choisir un habitat :</label>
    <select name="habitat_id" required>
        <?php foreach ($habitats as $h) : ?>
            <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['nom']) ?> (Capacité: <?= htmlspecialchars($h['description']) ?>)</option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Affecter</button>
</form>
