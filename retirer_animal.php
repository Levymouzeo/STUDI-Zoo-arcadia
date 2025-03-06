<?php
include 'config.php';

// Récupérer les animaux affectés à un habitat
$sql = "SELECT * FROM animal WHERE habitat_id IS NOT NULL";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_id = $_POST["animal_id"];

    // Mettre l'habitat_id à NULL
    $sql = "UPDATE animal SET habitat_id = NULL WHERE id = :animal_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':animal_id' => $animal_id]);

    echo "✅ L'animal a été retiré de son habitat avec succès !";
    // Recharger la page pour mettre à jour la liste
    header("Refresh:1");
}
?>

<h2>Retirer un animal de son habitat</h2>
<form method="POST">
    <label>Choisir un animal :</label>
    <select name="animal_id" required>
        <?php foreach ($animaux as $a) : ?>
            <option value="<?= $a['id'] ?>"><?= $a['nom'] ?> (<?= $a['race'] ?>) - Habitat ID: <?= $a['habitat_id'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Retirer</button>
</form>
